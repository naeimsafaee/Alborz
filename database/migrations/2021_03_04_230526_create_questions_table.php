<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration{

    public function up(){
        Schema::create('questions', function(Blueprint $table){
            $table->id();
            $table->string('title')->nullable();
            $table->text('question');
            $table->enum('type' , [0 , 1 , 2])->default(0);
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('questions');
    }

}
