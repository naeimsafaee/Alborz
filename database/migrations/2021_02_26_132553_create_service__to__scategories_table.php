<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceToScategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_to_scategories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('service_category_id');
            $table->timestamps();

            $table->foreign('service_id')->references('id')->on('services')->
            onDelete('cascade')->onUpdate('cascade');

            $table->foreign('service_category_id')->references('id')->on('service_categories')->
            onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service__to__scategories');
    }
}
