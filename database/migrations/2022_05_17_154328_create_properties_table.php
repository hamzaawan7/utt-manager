<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Enums\RoomLayout;


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
            $table->unsignedBigInteger('owner_id');
            $table->unsignedBigInteger('season_id');
            $table->unsignedBigInteger('price_category_id');
            $table->string('name');
            $table->string('short_code');
            $table->string('phone');
            $table->string('address');
            $table->string('post_code');
            $table->string('special_category');
            $table->timestamp('check_in_time')->nullable();
            $table->timestamp('check_out_time')->nullable();
            $table->integer('minimum_nights');
            $table->integer('standard_guests');
            $table->string('minimum_guest');
            $table->enum('room_layouts', [
                RoomLayout::SINGLE_BED,
                RoomLayout::DOUBLE_BED,
            ]);
            $table->integer('childs');
            $table->integer('infants');
            $table->integer('pets');
            $table->timestamp('special_start_days')->nullable();
            $table->integer('is_visible');
            $table->integer('min_seven_night_stay');
            $table->string('main_image');

            $table->timestamps();

            $table->foreign('owner_id')->references('id')->on('owners');
            $table->foreign('season_id')->references('id')->on('seasons');
            $table->foreign('price_category_id')->references('id')->on('price_categories');
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
