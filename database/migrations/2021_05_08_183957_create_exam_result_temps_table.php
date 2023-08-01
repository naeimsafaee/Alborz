<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamResultTempsTable extends Migration
{

    public function up()
    {
        Schema::create('exam_result_temps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exam_id');
            $table->integer('weight');
            $table->string('code');
            $table->timestamps();

            $table->foreign('exam_id')->references('id')->on('exams')
                ->onDelete('cascade')->onUpdate('cascade');

        });
    }


    public function down()
    {
        Schema::dropIfExists('exam_result_temps');
    }
}
