<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddItemsToQuestionsTable extends Migration{

    public function up(){
        Schema::table('questions', function(Blueprint $table){
            $table->boolean('need_instruction')->default(false)->after('type');
        });
    }

    public function down(){
        Schema::table('questions', function(Blueprint $table){
            //
        });
    }
}
