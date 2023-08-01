<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddItemsToPagesTable extends Migration{

    public function up(){
        Schema::table('pages', function(Blueprint $table){
            $table->text('image')->nullable()->after('content');
        });
    }


    public function down(){
        Schema::table('pages', function(Blueprint $table){
            //
        });
    }
}
