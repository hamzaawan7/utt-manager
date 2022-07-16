<?php

namespace App\Mail;
use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomerBooking extends Mailable
{
    use Queueable, SerializesModels;

    private $booking;

    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    /**
     * @return CustomerBooking
     */
    public function build(): CustomerBooking
    {
        return $this->view('emails.new_booking_template',[
            'booking'=> $this->booking,
        ]);
    }
}