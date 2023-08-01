<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoToServiceCategoriesTable extends Migration{

    public function up(){
        Schema::create('video_to_service_categories', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('service_category_id');
            $table->unsignedBigInteger('video_id');
            $table->timestamps();

            $table->foreign('video_id')->references('id')->on('videos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('service_category_id')->references('id')->on('service_categories')->onDelete('cascade')->onUpdate('cascade');
        });
    }


    public function down(){
        Schema::dropIfExists('video_to_service_categories');
    }

}
