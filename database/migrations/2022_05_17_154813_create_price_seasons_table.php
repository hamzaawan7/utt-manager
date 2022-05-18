<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriceSeasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_seasons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamp('from_date');
            $table->timestamp('to_date');
            $table->string('type');
            $table->foreignId('category_id')->nullable();

            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('price_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('price_seasons');
    }
}
