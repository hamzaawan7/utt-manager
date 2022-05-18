<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Enum\Breakdown;

class CreatePaymentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_details', function (Blueprint $table) {
            $table->id();
            $table->string('total_price');
            $table->enum('price_breakdown', [
                    Breakdown::HOLIDAY_PRICE,
                    Breakdown::BOOKING_FEE,
                    Breakdown::BOOKING,
                    Breakdown::PROTECT_FEE,
                    Breakdown::CHARITY,
                    Breakdown::DONATIONS,
            ]);
            $table->string('voucher_value_used');
            $table->string('deposit_amount');
            $table->string('total_balance_paid');
            $table->string('remaining_balance_paid');
            $table->date('balance_due_date');
            $table->foreignId('booking_id')->nullable();
            $table->foreignId('discount_id')->nullable();

            $table->timestamps();

            $table->foreign('booking_id')->references('id')->on('bookings');
            $table->foreign('discount_id')->references('id')->on('discounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_details');
    }
}
