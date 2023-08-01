<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageToServiceCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_categories', function (Blueprint $table) {
            $table->string('video_image')->after('doctor_id');
            $table->string('product_image')->after('video_image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('_service_category', function (Blueprint $table) {
            //
        });
    }
}
