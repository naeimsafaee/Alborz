<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientCommentToServiceCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_comment_to_service_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_comment_id');
            $table->unsignedBigInteger('service_category_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_comment_to_service_categories');
    }
}
