<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutUsTable extends Migration
{

    public function up()
    {
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();
            $table->string('display');
            $table->text('value');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('about_us');
    }
}
