<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacilitiesTable extends Migration{

    public function up(){
        Schema::create('facilities', function(Blueprint $table){
            $table->id();
            $table->string('title');
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }


    public function down(){
        Schema::dropIfExists('facilities');
    }
}
