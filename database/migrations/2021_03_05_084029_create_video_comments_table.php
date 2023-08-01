<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoCommentsTable extends Migration{

    public function up(){
        Schema::create('video_comments', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('video_id');
            $table->text('text');
            $table->unsignedBigInteger('reply_to')->nullable();
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('video_id')->references('id')->on('videos')->onDelete('cascade')->onUpdate('cascade');
        });
    }


    public function down(){
        Schema::dropIfExists('video_comments');
    }
}
