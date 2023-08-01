<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionsTable extends Migration{

    public function up(){
        Schema::create('options', function(Blueprint $table){
            $table->id();
            $table->string('text');
            $table->integer('weight'); 
            $table->unsignedBigInteger('question_id');
            $table->timestamps();

            $table->foreign('question_id')->references('id')->on('questions')->
            onDelete('cascade')->onUpdate('cascade');

        });
    }


    public function down(){
        Schema::dropIfExists('options');
    }
}
