<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddToBlogCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blog_comments', function (Blueprint $table) {
            $table->unsignedBigInteger('client_id')->after('id');
            $table->unsignedBigInteger('blog_id')->after('client_id');
            $table->text('text')->after('blog_id');
            $table->unsignedBigInteger('reply_to')->after('text');
            $table->boolean('is_active')->after('reply_to');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('_blog_comment', function (Blueprint $table) {
            //
        });
    }
}
