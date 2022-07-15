<?php

namespace App\Repositories\Eloquent;

use App\Models\Booking;
use App\Models\CleaningRota;
use App\Models\Property;
use App\Repositories\CustomerBookingRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Mail;

class CustomerBookingRepository implements CustomerBookingRepositoryInterface
{
    /**
     * @var Booking
     */
    private $booking;
    /**
     * @var CleaningRota
     */
    private $cleaningRota;
    /**
     * @var Property
     */
    private $property;

    /**
     * @param Booking $booking
     */
    public function __construct(
        Booking $booking,
        CleaningRota $cleaningRota,
        Property $property
    )
    {
        $this->booking      = $booking;
        $this->cleaningRota = $cleaningRota;
        $this->property     = $property;
    }

    /**
     * @param $data
     * @return JsonResponse|void
     */
    public function save($data)
    {
        if (isset($data['guest_booking'])) {
            try {
                $user_id                  = Auth::id();
                $booking                  = new $this->booking;
                $booking->user_id         = $user_id;
                $booking->property_id     = $data['guest_booking'];
                $booking->from_date       = $data['from_date'];
                $booking->to_date         = $data['to_date'];
                $booking->first_name      = $data['first_name'];
                $booking->last_name       = $data['last_name'];
                $booking->email           = $data['email'];
                $booking->total_price     = $data['pay_amount'];
                $booking->remaining_price = $data['remaining_amount'];
                $booking->guest           = $data['guest'];
                if ($data['remaining_amount'] === 0) {
                    $booking->status = "Fully Paid";
                }
                if ($data['remaining_amount'] > 0) {
                    $booking->status = "Part Paid";
                }
                $booking->save();
                $bookingId = $booking->id;
                Mail::send('emails.new_booking_template', $data, function($message) use ($data) {
                    $message->to($data['email'])
                        ->subject("heloo");
                });

                $propertyBooking                   = $this->property->where('id', intval($data['guest_booking']))->first();
                $cleaningRota                      = new $this->cleaningRota;
                $cleaningRota->booking_id          = $bookingId;
                $cleaningRota->guest_name          = $data['first_name'].' '.$data['last_name'];
                $cleaningRota->cleaning_rota_email = $propertyBooking->cleaning_rota_receipts;
                $cleaningRota->phone               = $propertyBooking->phone;
                $cleaningRota->from_date           = $data['from_date'];
                $cleaningRota->to_date             = $data['to_date'];
                $cleaningRota->nights              = $propertyBooking->minimum_nights;
                $cleaningRota->guests              = $data['guest'];
                $cleaningRota->childs              = $propertyBooking->childs;
                $cleaningRota->infants             = $propertyBooking->infants;
                $cleaningRota->pets                = $propertyBooking->pets;
                $cleaningRota->booking_note        = "booking Note";
                $cleaningRota->guest_note          = "guest Note";
                $cleaningRota->save();

                return response()->json([
                    'status' => 200,
                    'message' => 'Data Saved Successfully'
                ]);
            } catch (\Exception $e) {
                catchException($e->getMessage());
            }
        } else {
            try {
                $user_id = Auth::id();
                $booking = new $this->booking;
                $booking->user_id = $user_id;
                $booking->property_id = $data['owner_booking'];
                $booking->from_date = $data['from_date'];
                $booking->to_date = $data['to_date'];
                $booking->reason = $data['reason'];
                $booking->status = "Owner Booking";
                $booking->save();
                return response()->json([
                    'status' => 200,
                    'message' => 'Data Saved Successfully'
                ]);
            } catch (\Exception $e) {
                catchException($e->getMessage());
            }
        }
    }
}
