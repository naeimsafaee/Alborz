<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductOneUsedsTable extends Migration{

    public function up(){
        Schema::create('product_one_useds', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->string('link');
            $table->boolean('has_paid')->default(false);
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('product_one_useds');
    }
}
