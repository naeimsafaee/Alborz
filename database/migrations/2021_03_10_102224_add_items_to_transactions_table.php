<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddItemsToTransactionsTable extends Migration{

    public function up(){
        Schema::table('transactions', function(Blueprint $table){
            $table->boolean('is_product')->default(false);
        });
    }

    public function down(){
        Schema::table('transactions', function(Blueprint $table){
            //
        });
    }
}
