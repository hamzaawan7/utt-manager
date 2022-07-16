<?php

namespace App\Jobs;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CancleBookingIfNotPaid implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Booking
     */
    private $booking;

    /**
     * @param Booking $booking
     */
    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->booking->total_price !== 0) {
            return;
        }

        $this->booking->updateBooking($this->booking['id']);
    }
}
