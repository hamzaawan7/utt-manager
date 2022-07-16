<?php

namespace App\Repositories\Eloquent;

use App\Jobs\CancleBookingIfNotPaid;
use App\Mail\CustomerBooking;
use App\Mail\OwnerBooking;
use App\Mail\RotaBooking;
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
                $booking->remaining_price = intval($data['remaining_amount']);
                $booking->guest           = $data['guest'];
                if (intval($data['remaining_amount']) === 0) {
                    $booking->status = "Fully Paid";
                }
                if (intval($data['remaining_amount']) > 0) {
                    $booking->status = "Part Paid";
                }
                if (intval($data['pay_amount']) === 0) {
                    $booking->status = "Not Paid";
                }
                $booking->save();
                /*dd($data);*/
                /*$order = Booking::make([
                    'id' => $request->input('boosting_method'),
                    'user_id' => $request->input('queue_id'),
                    'property_id' => $request->input('region_id'),
                    'from_date' => $request->input('comment'),
                    'to_date' => $customer->vpn_location,
                    'first_name' => $request->input('flash_position'),
                    'last_name' => $request->input('flash_position'),
                    'email' => $request->input('flash_position'),
                    'total_price' => $request->input('flash_position'),
                    'remaining_price' => $request->input('flash_position'),
                    'guest' => $request->input('flash_position'),
                    'remaining_amount' => ($data['remaining_amount']),
                ]);*/


                $bookingId = $booking->id;
                $bookingData = $this->booking->find($bookingId);
                $bookings  = $this->property->leftJoin('bookings','bookings.property_id','=','properties.id')
                    ->where('properties.id',$data['guest_booking'])
                    ->select('properties.*','bookings.*')
                    ->first();

                Mail::to($bookings['email'])->send(new CustomerBooking($bookings));
                Mail::to($bookings['email'])->send(new OwnerBooking($bookings));
                Mail::to($bookings['cleaning_rota_receipts'])->send(new RotaBooking($bookings));

                CancleBookingIfNotPaid::dispatch($bookingData)->delay(now()->addMinute(3));

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
