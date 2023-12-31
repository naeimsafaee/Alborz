<?php

namespace App\Http\Controllers\Voyager;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use ReflectionClass;
use TCG\Voyager\Database\Schema\SchemaManager;
use TCG\Voyager\Database\Schema\Table;
use TCG\Voyager\Database\Types\Type;
use TCG\Voyager\Events\BreadAdded;
use TCG\Voyager\Events\BreadDeleted;
use TCG\Voyager\Events\BreadUpdated;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\Controller;
use TCG\Voyager\Http\Controllers\Traits\BreadRelationshipParser;

class VoyagerAnswerController extends VoyagerBaseController{

    use BreadRelationshipParser;

    public function index(Request $request){
        // GET THE SLUG, ex. 'posts', 'pages', etc.
        $slug = $this->getSlug($request);

        // GET THE DataType based on the slug
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('browse', app($dataType->model_name));

        $getter = $dataType->server_side ? 'paginate' : 'get';

        $search = (object)[
            'value' => $request->get('s'),
            'key' => $request->get('key'),
            'filter' => $request->get('filter'),
        ];

        $searchNames = [];
        if($dataType->server_side){
            $searchNames = $dataType->browseRows->mapWithKeys(function($row){
                return [$row['field'] => $row->getTranslatedAttribute('display_name')];
            });
        }

        $orderBy = $request->get('order_by', $dataType->order_column);
        $sortOrder = $request->get('sort_order', $dataType->order_direction);
        $usesSoftDeletes = false;
        $showSoftDeleted = false;

        // Next Get or Paginate the actual content from the MODEL that corresponds to the slug DataType
        if(strlen($dataType->model_name) != 0){
            $model = app($dataType->model_name);

            $query = $model::select($dataType->name . '.*');

            if($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope' . ucfirst($dataType->scope))){
                $query->{$dataType->scope}();
            }

            // Use withTrashed() if model uses SoftDeletes and if toggle is selected
            if($model && in_array(SoftDeletes::class, class_uses_recursive($model)) && Auth::user()->can('delete', app($dataType->model_name))){
                $usesSoftDeletes = true;

                if($request->get('showSoftDeleted')){
                    $showSoftDeleted = true;
                    $query = $query->withTrashed();
                }
            }

            // If a column has a relationship associated with it, we do not want to show that field
            $this->removeRelationshipField($dataType, 'browse');

            if($search->value != '' && $search->key && $search->filter){
                $search_filter = ($search->filter == 'equals') ? '=' : 'LIKE';
                $search_value = ($search->filter == 'equals') ? $search->value : '%' . $search->value . '%';

                $searchField = $dataType->name . '.' . $search->key;
                if($row = $this->findSearchableRelationshipRow($dataType->rows->where('type', 'relationship'), $search->key)){
                    $query->whereIn($searchField, $row->details->model::where($row->details->label, $search_filter, $search_value)->pluck('id')->toArray());
                } else {
                    if($dataType->browseRows->pluck('field')->contains($search->key)){
                        $query->where($searchField, $search_filter, $search_value);
                    }
                }
            }

            $row = $dataType->rows->where('field', $orderBy)->firstWhere('type', 'relationship');
            if($orderBy && (in_array($orderBy, $dataType->fields()) || !empty($row))){
                $querySortOrder = (!empty($sortOrder)) ? $sortOrder : 'desc';
                if(!empty($row)){
                    $query->select([
                        $dataType->name . '.*',
                        'joined.' . $row->details->label . ' as ' . $orderBy,
                    ])->leftJoin($row->details->table . ' as joined', $dataType->name . '.' . $row->details->column, 'joined.' . $row->details->key);
                }

                $dataTypeContent = call_user_func([
                    $query->orderBy($orderBy, $querySortOrder),
                    $getter,
                ]);
            } elseif($model->timestamps) {
                $dataTypeContent = call_user_func([$query->latest($model::CREATED_AT), $getter]);
            } else {
                $dataTypeContent = call_user_func([$query->orderBy($model->getKeyName(), 'DESC'), $getter]);
            }

            // Replace relationships' keys for labels and create READ links if a slug is provided.
            $dataTypeContent = $this->resolveRelations($dataTypeContent, $dataType);
        } else {
            // If Model doesn't exist, get data from table name
            $dataTypeContent = call_user_func([DB::table($dataType->name), $getter]);
            $model = false;
        }

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($model);

        // Eagerload Relations
        $this->eagerLoadRelations($dataTypeContent, $dataType, 'browse', $isModelTranslatable);

        // Check if server side pagination is enabled
        $isServerSide = isset($dataType->server_side) && $dataType->server_side;

        // Check if a default search key is set
        $defaultSearchKey = $dataType->default_search_key ?? null;


        // Actions
        $actions = [];
        if(!empty($dataTypeContent->first())){
            foreach(Voyager::actions() as $action){

                $action = new $action($dataType, $dataTypeContent->first());

                if($action->shouldActionDisplayOnDataType()){
                    $actions[] = $action;
                }
            }
        }
        // Define showCheckboxColumn
        $showCheckboxColumn = false;
        if(Auth::user()->can('delete', app($dataType->model_name))){
            $showCheckboxColumn = true;
        } else {
            foreach($actions as $action){
                if(method_exists($action, 'massAction')){
                    $showCheckboxColumn = true;
                }
            }
        }

        // Define orderColumn
        $orderColumn = [];
        if($orderBy){
            $index = $dataType->browseRows->where('field', $orderBy)->keys()->first() + ($showCheckboxColumn ? 1 : 0);
            $orderColumn = [[$index, $sortOrder ?? 'desc']];
        }

        // Define list of columns that can be sorted server side
        $sortableColumns = $this->getSortableColumns($dataType->browseRows);

        $view = "voyager::$slug.groups";

        /*if(view()->exists("voyager::$slug.browse")){
            $view = "voyager::$slug.browse";
        }*/

        $dataTypeContent = $dataTypeContent->groupBy(['client_id', 'exam_id']);

        return Voyager::view($view, compact('actions', 'dataType', 'dataTypeContent', 'isModelTranslatable', 'search', 'orderBy', 'orderColumn', 'sortableColumns', 'sortOrder', 'searchNames', 'isServerSide', 'defaultSearchKey', 'usesSoftDeletes', 'showSoftDeleted', 'showCheckboxColumn'));
    }

    public function show(Request $request, $id){

        $is_group = $request->has('group');


        if($is_group){

            $slug = $this->getSlug($request);

            // GET THE DataType based on the slug
            $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

            // Check permission
            $this->authorize('browse', app($dataType->model_name));

            $getter = $dataType->server_side ? 'paginate' : 'get';

            $search = (object)[
                'value' => $request->get('s'),
                'key' => $request->get('key'),
                'filter' => $request->get('filter'),
            ];

            $searchNames = [];
            if($dataType->server_side){
                $searchNames = $dataType->browseRows->mapWithKeys(function($row){
                    return [$row['field'] => $row->getTranslatedAttribute('display_name')];
                });
            }

            $orderBy = $request->get('order_by', $dataType->order_column);
            $sortOrder = $request->get('sort_order', $dataType->order_direction);
            $usesSoftDeletes = false;
            $showSoftDeleted = false;

            // Next Get or Paginate the actual content from the MODEL that corresponds to the slug DataType
            if(strlen($dataType->model_name) != 0){
                $model = app($dataType->model_name);

                $query = $model::select($dataType->name . '.*');

                if($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope' . ucfirst($dataType->scope))){
                    $query->{$dataType->scope}();
                }

                // Use withTrashed() if model uses SoftDeletes and if toggle is selected
                if($model && in_array(SoftDeletes::class, class_uses_recursive($model)) && Auth::user()->can('delete', app($dataType->model_name))){
                    $usesSoftDeletes = true;

                    if($request->get('showSoftDeleted')){
                        $showSoftDeleted = true;
                        $query = $query->withTrashed();
                    }
                }

                // If a column has a relationship associated with it, we do not want to show that field
                $this->removeRelationshipField($dataType, 'browse');

                if($search->value != '' && $search->key && $search->filter){
                    $search_filter = ($search->filter == 'equals') ? '=' : 'LIKE';
                    $search_value = ($search->filter == 'equals') ? $search->value : '%' . $search->value . '%';

                    $searchField = $dataType->name . '.' . $search->key;
                    if($row = $this->findSearchableRelationshipRow($dataType->rows->where('type', 'relationship'), $search->key)){
                        $query->whereIn($searchField, $row->details->model::where($row->details->label, $search_filter, $search_value)->pluck('id')->toArray());
                    } else {
                        if($dataType->browseRows->pluck('field')->contains($search->key)){
                            $query->where($searchField, $search_filter, $search_value);
                        }
                    }
                }

                $row = $dataType->rows->where('field', $orderBy)->firstWhere('type', 'relationship');
                if($orderBy && (in_array($orderBy, $dataType->fields()) || !empty($row))){
                    $querySortOrder = (!empty($sortOrder)) ? $sortOrder : 'desc';
                    if(!empty($row)){
                        $query->select([
                            $dataType->name . '.*',
                            'joined.' . $row->details->label . ' as ' . $orderBy,
                        ])->leftJoin($row->details->table . ' as joined', $dataType->name . '.' . $row->details->column, 'joined.' . $row->details->key);
                    }

                    $dataTypeContent = call_user_func([
                        $query->orderBy($orderBy, $querySortOrder),
                        $getter,
                    ]);
                } elseif($model->timestamps) {
                    $dataTypeContent = call_user_func([$query->latest($model::CREATED_AT), $getter]);
                } else {
                    $dataTypeContent = call_user_func([$query->orderBy($model->getKeyName(), 'DESC'), $getter]);
                }

                // Replace relationships' keys for labels and create READ links if a slug is provided.
                $dataTypeContent = $this->resolveRelations($dataTypeContent, $dataType);
            } else {
                // If Model doesn't exist, get data from table name
                $dataTypeContent = call_user_func([DB::table($dataType->name), $getter]);
                $model = false;
            }

            // Check if BREAD is Translatable
            $isModelTranslatable = is_bread_translatable($model);

            // Eagerload Relations
            $this->eagerLoadRelations($dataTypeContent, $dataType, 'browse', $isModelTranslatable);

            // Check if server side pagination is enabled
            $isServerSide = isset($dataType->server_side) && $dataType->server_side;

            // Check if a default search key is set
            $defaultSearchKey = $dataType->default_search_key ?? null;


            // Actions
            $actions = [];
            if(!empty($dataTypeContent->first())){
                foreach(Voyager::actions() as $action){

                    $action = new $action($dataType, $dataTypeContent->first());

                    if($action->shouldActionDisplayOnDataType()){
                        $actions[] = $action;
                    }
                }
            }
            // Define showCheckboxColumn
            $showCheckboxColumn = false;
            if(Auth::user()->can('delete', app($dataType->model_name))){
                $showCheckboxColumn = true;
            } else {
                foreach($actions as $action){
                    if(method_exists($action, 'massAction')){
                        $showCheckboxColumn = true;
                    }
                }
            }

            // Define orderColumn
            $orderColumn = [];
            if($orderBy){
                $index = $dataType->browseRows->where('field', $orderBy)->keys()->first() + ($showCheckboxColumn ? 1 : 0);
                $orderColumn = [[$index, $sortOrder ?? 'desc']];
            }

            // Define list of columns that can be sorted server side
            $sortableColumns = $this->getSortableColumns($dataType->browseRows);

            $view = "voyager::$slug.browse";

            $dataTypeContent = $dataTypeContent->groupBy(['client_id', 'exam_id'])->toArray();

            $dataTypeContent = array_values($dataTypeContent[$request->group][$request->group1]);

            $dataTypeContent = collect($dataTypeContent)->map(function($voucher){
                return (object)$voucher;
            });

            if($dataTypeContent->count() > 0){
                $client_id = $dataTypeContent->first()->client_id;
                $exam_id = $dataTypeContent->first()->exam_id;
            } else {
                $exam_id = 0;
                $client_id = 0;
            }

            return Voyager::view($view, compact('client_id', 'exam_id', 'actions', 'dataType', 'dataTypeContent', 'isModelTranslatable', 'search', 'orderBy', 'orderColumn', 'sortableColumns', 'sortOrder', 'searchNames', 'isServerSide', 'defaultSearchKey', 'usesSoftDeletes', 'showSoftDeleted', 'showCheckboxColumn'));
        } else {
            $slug = $this->getSlug($request);

            $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

            $isSoftDeleted = false;

            if(strlen($dataType->model_name) != 0){
                $model = app($dataType->model_name);
                $query = $model->query();

                // Use withTrashed() if model uses SoftDeletes and if toggle is selected
                if($model && in_array(SoftDeletes::class, class_uses_recursive($model))){
                    $query = $query->withTrashed();
                }
                if($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope' . ucfirst($dataType->scope))){
                    $query = $query->{$dataType->scope}();
                }
                $dataTypeContent = call_user_func([$query, 'findOrFail'], $id);
                if($dataTypeContent->deleted_at){
                    $isSoftDeleted = true;
                }
            } else {
                // If Model doest exist, get data from table name
                $dataTypeContent = DB::table($dataType->name)->where('id', $id)->first();
            }

            // Replace relationships' keys for labels and create READ links if a slug is provided.
            $dataTypeContent = $this->resolveRelations($dataTypeContent, $dataType, true);

            // If a column has a relationship associated with it, we do not want to show that field
            $this->removeRelationshipField($dataType, 'read');

            // Check permission
            $this->authorize('read', $dataTypeContent);

            // Check if BREAD is Translatable
            $isModelTranslatable = is_bread_translatable($dataTypeContent);

            // Eagerload Relations
            $this->eagerLoadRelations($dataTypeContent, $dataType, 'read', $isModelTranslatable);

            $view = 'voyager::bread.read';

            if(view()->exists("voyager::$slug.read")){
                $view = "voyager::$slug.read";
            }

            return Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable', 'isSoftDeleted'));
        }

    }

    protected function getSortableColumns($rows){
        return $rows->filter(function($item){
            if($item->type != 'relationship'){
                return true;
            }
            if($item->details->type != 'belongsTo'){
                return false;
            }

            return !$this->relationIsUsingAccessorAsLabel($item->details);
        })->pluck('field')->toArray();
    }

    protected function relationIsUsingAccessorAsLabel($details){
        return in_array($details->label, app($details->model)->additional_attributes ?? []);
    }


}
