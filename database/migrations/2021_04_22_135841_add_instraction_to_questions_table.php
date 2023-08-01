<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInstractionToQuestionsTable extends Migration
{

    public function up()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->string('instruction_title')->nullable()->after('need_instruction');
            $table->text('instruction')->nullable()->after('instruction_title');
        });
    }


    public function down()
    {
        Schema::table('questions', function (Blueprint $table) {
            //
        });
    }
}
