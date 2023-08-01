<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddItemsToFacilitiesTable extends Migration
{

    public function up()
    {
        Schema::table('facilities', function (Blueprint $table) {
            $table->text('link')->nullable()->after('description');
        });
    }


    public function down()
    {
        Schema::table('facilities', function (Blueprint $table) {
            //
        });
    }
}
