<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration{

    public function up(){
        Schema::create('answers', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('client_id');
            $table->string('file')->nullable();
            $table->text('answer')->nullable();
            $table->integer('weight')->default(0);
            $table->timestamps();
        });
    }


    public function down(){
        Schema::dropIfExists('answers');
    }
}
