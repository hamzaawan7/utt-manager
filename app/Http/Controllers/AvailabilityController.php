<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Property;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

/**
 * Class AvailabilityController
 * @package App\Http\Controllers
 */
class AvailabilityController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $availabilityLisy = Property::all();

        return view('booking.availability_list',compact('availabilityLisy'));
    }

    public function individualCalendar($id)
    {
      $property = Property::where('id', $id)->with('images')->first();
      $booking  = Booking::all();

      return view('booking.individual_calendar',compact('property','booking'));
    }
}
