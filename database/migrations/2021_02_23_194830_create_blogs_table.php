<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration{

    public function up(){
        Schema::create('blogs', function(Blueprint $table){
            $table->id();
            $table->string('title');
            $table->string('image');
            $table->text('description');
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->integer('view')->default(0);
            $table->timestamps();

            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down(){
        Schema::dropIfExists('blogs');
    }
}
