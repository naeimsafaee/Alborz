<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddItemsToHeadingsTable extends Migration{

    public function up(){
        Schema::table('headings', function(Blueprint $table){
            $table->boolean('show_doctor')->after('video')->default(true);
        });
    }


    public function down(){
        Schema::table('headings', function(Blueprint $table){
            //
        });
    }
}
