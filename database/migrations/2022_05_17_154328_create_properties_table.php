<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->nullable();
            $table->string('name');
            $table->string('short_code');
            $table->string('phone');
            $table->string('address');
            $table->string('post_code');
            $table->string('special_category');
            $table->string('utt_star_rating');
            $table->integer('is_visible');
            $table->string('main_image');

            $table->timestamps();

            $table->foreign('owner_id')->references('id')->on('owners');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
