<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration{

    public function up(){
        Schema::create('services', function(Blueprint $table){
            $table->id();
            $table->string("title");
            $table->text("description")->nullable();
            $table->text("image")->nullable();
            $table->text("video")->nullable();
            $table->unsignedBigInteger('doctor_id');
            $table->timestamps();

            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade')->onUpdate('cascade');
        });
    }


    public function down(){
        Schema::dropIfExists('services');
    }
}
