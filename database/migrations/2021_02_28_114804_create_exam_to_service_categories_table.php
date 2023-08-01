<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamToServiceCategoriesTable extends Migration{

    public function up(){
        Schema::create('exam_to_service_categories', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('exam_id');
            $table->unsignedBigInteger('service_category_id');
            $table->timestamps();

            $table->foreign('exam_id')->references('id')->on('exams')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('service_category_id')->references('id')->on('service_categories')->onDelete('cascade')->onUpdate('cascade');

        });
    }


    public function down(){
        Schema::dropIfExists('exam_to_service_categories');
    }
}
