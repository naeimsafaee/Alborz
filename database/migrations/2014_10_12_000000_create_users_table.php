<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration{
    /**
     * Run the migrations.
     * @return void
     */
    public function up(){
        Schema::create('users', function(Blueprint $table){

            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone')->default('')->nullable();
            $table->integer('phone_serial')->default(0)->nullable();
            $table->integer('verify_code')->default(0)->nullable();
            $table->datetime('verify_code_validate')->nullable();
            $table->text('fcm_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     * @return void
     */
    public function down(){
        Schema::dropIfExists('users');
    }
}

