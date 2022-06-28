<?php

namespace App\Repositories\Eloquent;

use App\Models\Booking;
use App\Repositories\CustomerBookingRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class CustomerBookingRepository implements CustomerBookingRepositoryInterface
{
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
     * @param $data
     * @return JsonResponse|void
     */
    public function save($data)
    {
        try {
            $user_id = Auth::id();
            $booking = new $this->booking;
            $booking->user_id = $user_id;
            $booking->property_id = $data['property_id'];
            $booking->from_date = $data['from_date'];
            $booking->to_date = $data['to_date'];
            $booking->first_name = $data['first_name'];
            $booking->last_name = $data['last_name'];
            $booking->email = $data['email'];
            $booking->price = $data['standrad_price'];
            $booking->guest = $data['guest'];
            $booking->status = 1;
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
