<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsActiveToVideoCommentsTable extends Migration
{

    public function up()
    {
        Schema::table('video_comments', function (Blueprint $table) {
            $table->boolean('is_active')->default(false)->after('reply_to');
        });
    }


    public function down()
    {
        Schema::table('video_comments', function (Blueprint $table) {
            //
        });
    }
}
