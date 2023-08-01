<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddItemsToProductsTable extends Migration{

    public function up(){
        Schema::table('products', function(Blueprint $table){
            $table->text('description2')->after('description')->nullable();
        });
    }


    public function down(){
        Schema::table('products', function(Blueprint $table){
            //
        });
    }
}
