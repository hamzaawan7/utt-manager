<?php

use App\Models\Enums\RoomLayout;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('standard_guests');
            $table->string('minimum_guest');
            $table->enum('room_layouts', [
                RoomLayout::SINGLE_BED,
                RoomLayout::DOUBLE_BED,
            ]);
            $table->string('childs');
            $table->string('infants');
            $table->string('pets');

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
        Schema::dropIfExists('categories');
    }
}
