<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model{

    protected $appends = [
        'slug',
        'sells',
        'title',
        'short_desc',
        'shamsi_date',
        'shamsi_date_1'
    ];

    protected $fillable = [
        "name",
        "price",
        "discounted_price",
        'main_image',
        'description',
    ];

    public function getSellsAttribute(){
        return Transaction::query()->where(['product_id' => $this->id, 'paid' => true])->count();
    }

    public function getTitleAttribute(){
        return $this->name;
    }

    public function getSlugAttribute(){
        return str_replace(" ", "_", $this->name);
    }

    public function getShortDescAttribute(){
        $str = substr(strip_tags($this->description), 0, 220);
        return (substr($str, 0, strrpos($str, " "))) . "....";
    }

    public function headings(){
        return $this->hasManyThrough(Heading::class, ProductToHeading::class, 'product_id', // Foreign key on the environments table...
            'id', // Foreign key on the deployments table...
            'id', // Local key on the projects table...
            'heading_id' // Local key on the environments table...
        );
    }

    public function getShamsiDateAttribute(){
        if(!$this->created_at)
            return "";
        $date = jdate($this->created_at);
        $date = substr($date, 0, strpos($date, " "));

        $date = explode("-", $date);

        switch($date[1]){
            case 1:
                $date[1] = "فروردین";
                break;
            case 2:
                $date[1] = "اردیبهشت";
                break;
            case 3:
                $date[1] = "خرداد";
                break;
            case 4:
                $date[1] = "تیر";
                break;
            case 5:
                $date[1] = "مرداد";
                break;
            case 6:
                $date[1] = "شهریور";
                break;
            case 7:
                $date[1] = "مهر";
                break;
            case 8:
                $date[1] = "آبان";
                break;
            case 9:
                $date[1] = "آذر";
                break;
            case 10:
                $date[1] = "دی";
                break;
            case 11:
                $date[1] = "بهمن";
                break;
            case 12:
                $date[1] = "اسفند";
                break;
        }

        return implode(" ", $date);
    }

    public function getShamsiDate1Attribute(){

        if(!auth()->guard('clients')->check())
            return "";
        $client_product = ClientProduct::query()->where([
            'client_id' => auth()->guard('clients')->user()->id,
            'product_id' => $this->id
        ])->first();

        if(!$client_product)
            return "";

        $created_at = $client_product->created_at;

        if(!$created_at)
            return "";
        $date = jdate($created_at);
        $date = substr($date, 0, strpos($date, " "));

        $date = explode("-", $date);

        switch($date[1]){
            case 1:
                $date[1] = "فروردین";
                break;
            case 2:
                $date[1] = "اردیبهشت";
                break;
            case 3:
                $date[1] = "خرداد";
                break;
            case 4:
                $date[1] = "تیر";
                break;
            case 5:
                $date[1] = "مرداد";
                break;
            case 6:
                $date[1] = "شهریور";
                break;
            case 7:
                $date[1] = "مهر";
                break;
            case 8:
                $date[1] = "آبان";
                break;
            case 9:
                $date[1] = "آذر";
                break;
            case 10:
                $date[1] = "دی";
                break;
            case 11:
                $date[1] = "بهمن";
                break;
            case 12:
                $date[1] = "اسفند";
                break;
        }

        return implode(" ", $date);
    }

    public function doctor(){
        return $this->hasOne(Doctor::class, 'id', 'doctor_id');
    }

    public function category(){
        return $this->hasManyThrough(
            Service_Category::class,
            ProductToServiceCategory::class,
            'product_id', // Foreign key on the environments table...
            'id', // Foreign key on the deployments table...
            'id', // Local key on the projects table...
            'service_category_id' // Local key on the environments table...
        );
    }

    public function prerequisites(){
        return $this->belongsToMany(Exam::class, 'prerequisites');
    }
}
