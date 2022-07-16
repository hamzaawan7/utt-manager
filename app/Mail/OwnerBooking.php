<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OwnerBooking extends Mailable
{
    use Queueable, SerializesModels;

    private $booking;

    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    /**
     * @return OwnerBooking
     */
    public function build(): OwnerBooking
    {
        return $this->view('emails.owner_mail_template',[
            'booking'=> $this->booking,
        ]);
    }

}