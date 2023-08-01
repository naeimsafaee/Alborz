<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddItemsToVideosTable extends Migration{

    public function up(){
        Schema::table('videos', function(Blueprint $table){
            $table->text('twitter_link')->nullable()->after('price');
            $table->text('telegram_link')->nullable()->after('twitter_link');
            $table->text('whatsapp_link')->nullable()->after('telegram_link');
        });
    }

    public function down(){
        Schema::table('videos', function(Blueprint $table){
            //
        });
    }
}
