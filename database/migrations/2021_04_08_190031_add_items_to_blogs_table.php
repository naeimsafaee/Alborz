<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddItemsToBlogsTable extends Migration{

    public function up(){
        Schema::table('blogs', function(Blueprint $table){
            $table->text('twitter_link')->nullable()->after('view');
            $table->text('telegram_link')->nullable()->after('twitter_link');
            $table->text('whatsapp_link')->nullable()->after('telegram_link');
        });
    }


    public function down(){
        Schema::table('blogs', function(Blueprint $table){
            //
        });
    }
}
