<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExamIdToAnswersTable extends Migration{

    public function up(){
        Schema::table('answers', function(Blueprint $table){
            $table->unsignedBigInteger('exam_id');
        });
    }


    public function down(){
        Schema::table('answers', function(Blueprint $table){
            //
        });
    }
}
