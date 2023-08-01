<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFileToClientsSupportsTable extends Migration{

    public function up(){
        Schema::table('clients_supports', function(Blueprint $table){
            $table->text('file')->nullable();
        });
    }

    public function down(){
        Schema::table('clients_supports', function(Blueprint $table){
            //
        });
    }
}
