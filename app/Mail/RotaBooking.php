<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RotaBooking extends Mailable
{

    use Queueable, SerializesModels;

    private $booking;

    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    /**
     * @return RotaBooking
     */
    public function build(): RotaBooking
    {
        return $this->view('emails.cleaning_rota_template',[
            'booking'=> $this->booking,
        ]);
    }
}