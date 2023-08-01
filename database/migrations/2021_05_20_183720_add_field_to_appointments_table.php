<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldToAppointmentsTable extends Migration{

    public function up(){
        Schema::table('appointments', function(Blueprint $table){
            $table->boolean('seen')->default(false)->after('description');
        });
    }

    public function down(){
        Schema::table('appointments', function(Blueprint $table){
            //
        });
    }
}
