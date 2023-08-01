<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestResultsTable extends Migration{

    public function up(){
        Schema::create('request_results', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('exam_id');
            $table->unsignedBigInteger('client_id');
            $table->text('answer')->nullable();
            $table->integer('rate');
            $table->timestamps();
        });
    }


    public function down(){
        Schema::dropIfExists('request_results');
    }
}
