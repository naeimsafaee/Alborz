<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;

/*
Route::group(['prefix' => 'admin'], function(){
    Voyager::routes();
});*/
Route::namespace('Admin')->group(function(){
    Route::get('locale/{lang}', 'LocalController@setLocale')->middleware('web');
    Route::group(['prefix' => 'admin'], function(){
        Voyager::routes();
        Route::group(['middleware' => 'admin.user'], function(){
            /*personalizemenus*/
            Route::post('personalizemenus/set', 'personalizemenus@set');
            Route::post('personalizemenus/delete', 'personalizemenus@delete');
            Route::post('personalizemenus/update', 'personalizemenus@update');
            /*notes*/
            Route::post('notes/set', 'NoteController@set');
            Route::post('notes/delete', 'NoteController@delete');
            /*chargesms*/ // Route::post('chargesms', 'TransactionController@chargesms');
            /*chart*/
            Route::get('chartdata', 'ChartController');
            /*messagetemplate */
            Route::post('messagetemplate/set', 'MessagetemplateController@set');
            Route::post('messagetemplate/delete', 'MessagetemplateController@delete');
            /*support */
            Route::post('support/sendmessage', 'SupportController@sendmessage');
            Route::post('support/readmessage', 'SupportController@readmessage');
            Route::get('support/getmessage', 'SupportController@getmessages');
            Route::post('support/lockmessage', 'SupportController@lockmessage');
            //Route::post('support/createmessage', 'SupportController@createmessage');
            Route::post('support/banuser', 'SupportController@banuser');

            Route::group(['as' => 'voyager.'], function (){

                $namespacePrefix = '\\'.config('voyager.controllers.namespace').'\\';

                Route::group([
                    'as' => 'metas.',
                    'prefix' => 'metas/{meta}',
                ], function() use ($namespacePrefix){
                    Route::get('builder', [
                        'uses' => 'VoyagerMetaController@builder',
                        'as' => 'builder'
                    ]);
                    Route::post('order', [
                        'uses' => $namespacePrefix . 'VoyagerMenuController@order_item',
                        'as' => 'order_item'
                    ]);

                    Route::group([
                        'as' => 'item.',
                        'prefix' => 'item',
                    ], function() use ($namespacePrefix){
                        Route::delete('{id}', [
                            'uses' => 'VoyagerMetaController@delete_menu',
                            'as' => 'destroy'
                        ]);
                        Route::post('/', [
                            'uses' => 'VoyagerMetaController@add_item',
                            'as' => 'add'
                        ]);
                        Route::put('/', [
                            'uses' => $namespacePrefix . 'VoyagerMenuController@update_item',
                            'as' => 'update'
                        ]);
                    });
                });
            });
        });

    });

});
