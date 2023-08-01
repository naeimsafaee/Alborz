<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamResultsTable extends Migration
{

    public function up()
    {
        Schema::create('exam_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exam_id');
            $table->integer('min');
            $table->integer('max');
            $table->text('text');
            $table->timestamps();  

            $table->foreign('exam_id')->references('id')->on('exams')
                ->onDelete('cascade')->onUpdate('cascade');

        });
    }


    public function down()
    {
        Schema::dropIfExists('exam_results');
    }
}
