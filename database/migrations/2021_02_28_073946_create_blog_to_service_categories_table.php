<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogToServiceCategoriesTable extends Migration{

    public function up(){
        Schema::create('blog_to_service_categories', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('service_category_id');
            $table->unsignedBigInteger('blog_id');
            $table->timestamps();

            $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('service_category_id')->references('id')->on('service_categories')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    public function down(){
        Schema::dropIfExists('blog_to_service_categories');
    }

}
