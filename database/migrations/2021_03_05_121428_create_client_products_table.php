<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientProductsTable extends Migration{

    public function up(){
        Schema::create('client_products', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('product_id');
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
        });
    }


    public function down(){
        Schema::dropIfExists('client_products');
    }
}
