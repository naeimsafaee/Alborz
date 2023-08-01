<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientComments extends Model{

    protected $appends = ['link'];


    public function getLinkAttribute(){

        if(!$this->voice)
            return "";

        $array = json_decode($this->voice, true);
        if (count($array) == 0) {
            return "";
        }
        $link = $array[count($array) - 1]["download_link"];

        return get_image($link);
    }

}
