<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wallet_transaction_id')->nullable();
            $table->double('amount')->nullable();
            $table->string('card_number', 20)->nullable();
            $table->boolean('paid')->default(false);
            $table->unsignedInteger('client_id');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->json('transaction_data')->nullable();
            $table->string('status')->nullable();
            $table->timestamp('transaction_date')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
