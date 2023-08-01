<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinishedExamsTable extends Migration{

    public function up(){
        Schema::create('finished_exams', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('exam_id');
            $table->unsignedBigInteger('client_id');
            $table->text('answer')->nullable();
            $table->integer('weight');
            $table->string('code')->nullable();
            $table->timestamps();
        });
    }


    public function down(){
        Schema::dropIfExists('finished_exams');
    }
}
