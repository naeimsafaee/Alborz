<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswerToRequestResultsTable extends Migration{

    public function up(){
        Schema::create('answer_to_request_results', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('answer_id');
            $table->unsignedBigInteger('request_result_id');
            $table->timestamps();
        });
    }


    public function down(){
        Schema::dropIfExists('answer_to_request_results');
    }
}
