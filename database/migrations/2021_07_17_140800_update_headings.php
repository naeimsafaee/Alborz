<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateHeadings extends Migration
{
    public function up(){
        Schema::table('headings', function(Blueprint $table){
            $table->dropColumn('product_type');
            $table->string('voice')->nullable();
            $table->string('pdf')->nullable();
        });
    }


    public function down(){
        Schema::table('headings', function(Blueprint $table){
            //
        });
    }
}
