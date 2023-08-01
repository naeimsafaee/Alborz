<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddItemsToExamsTable extends Migration{

    public function up(){
        Schema::table('exams', function(Blueprint $table){
            $table->text('has_answer')->nullable()->after('price');
        });
    }


    public function down(){
        Schema::table('exams', function(Blueprint $table){
            //
        });
    }
}
