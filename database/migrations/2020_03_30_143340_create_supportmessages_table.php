<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportmessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supportmessages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('support_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('client_id');
            $table->string('message')->default('');
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
        Schema::dropIfExists('supportmessages');
    }
}
