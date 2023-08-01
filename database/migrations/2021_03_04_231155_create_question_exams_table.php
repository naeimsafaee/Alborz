<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionExamsTable extends Migration
{

    public function up()
    {
        Schema::create('question_exams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('exam_id');
            $table->timestamps();

            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('exam_id')->references('id')->on('exams')->onDelete('cascade')->onUpdate('cascade');
        });
    }


    public function down()
    {
        Schema::dropIfExists('question_exams');
    }
}
