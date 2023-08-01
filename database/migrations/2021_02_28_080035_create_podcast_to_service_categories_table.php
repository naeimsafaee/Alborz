<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePodcastToServiceCategoriesTable extends Migration{

    public function up(){
        Schema::create('podcast_to_service_categories', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('service_category_id');
            $table->unsignedBigInteger('podcast_id');
            $table->timestamps();

            $table->foreign('podcast_id')->references('id')->on('podcasts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('service_category_id')->references('id')->on('service_categories')->onDelete('cascade')->onUpdate('cascade');

        });
    }


    public function down(){
        Schema::dropIfExists('podcast_to_service_categories');
    }

}
