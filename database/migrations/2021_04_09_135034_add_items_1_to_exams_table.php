<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddItems1ToExamsTable extends Migration{

    public function up(){
        Schema::table('exams', function(Blueprint $table){
            $table->string('instruction_title')->nullable()->after('has_answer');
            $table->text('instruction')->nullable()->after('instruction_title');
        });
    }


    public function down(){
        Schema::table('exams', function(Blueprint $table){
            //
        });
    }
}
