<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddItemsToServicesTable extends Migration{

    public function up(){
        Schema::table('services', function(Blueprint $table){
            $table->string('above_text')->nullable()->after('video');
            $table->string('title_text')->nullable()->after('above_text');
        });
    }


    public function down(){
        Schema::table('services', function(Blueprint $table){
            //
        });
    }

}
