<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Property;
use DateInterval;
use DatePeriod;
use DateTime;
use Exception;
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
     * @var Property
     */
    private $property;
    /**
     * @var Booking
     */
    private $booking;

    /**
     * @param Property $property
     * @param Booking $booking
     */
    public function __construct(
        Property $property,
        Booking $booking
    )
    {
        $this->property = $property;
        $this->booking  = $booking;
    }

    /**
     * @return Application|Factory|View
     * @throws Exception
     */
    public function index()
    {
        $dataArray    = [];
        $finalDate    = [];
        $betweenDates = [];
        $availabilityList = $this->property->with('bookings')->get();
            foreach ($availabilityList as $properties)
            {
                foreach ($properties['bookings'] as $property)
                {
                    $response    = $this->getDatesFromRange($property->from_date, $property->to_date);
                }
                if (!empty($response)) {
                    $properties->dates= $response;
                }
            }

        return view('booking.availability_list',compact('availabilityList'));
    }

    /**
     * @param $id
     * @return Application|Factory|View
     * @throws Exception
     */
    public function individualCalendar($id)
    {
      $datesArray = [];
      $betweenDates = [];
      $finalDate = [];
      $property = $this->property->where('id', $id)->first();
      $booking  = $this->booking->where('property_id', $id)->get();
      $property = $this->property->all();
      foreach ($booking as $book)
      {
          $arrayDate = array("fromDate" => $book->from_date, "toDate" => $book->to_date);
          $datesArray[] = $arrayDate;
      }

      foreach ($datesArray as $date)
      {
          $response = $this->getDatesFromRange($date['fromDate'], $date['toDate']);
          $betweenDates[] = $response;
      }

      foreach ($betweenDates as $date)
      {
          foreach ($date as $dt)
          {
              $finalDate[] = date('Y,m,d',strtotime($dt));
          }
      }

      return view('booking.individual_calendar',compact('property','finalDate'));
    }

    /**
     * @throws Exception
     */
    public function getDatesFromRange($start, $end, $format = 'Y-m-d'): array
    {
        $array = array();
        $interval = new DateInterval('P1D');
        $realEnd = new DateTime($end);
        $realEnd->add($interval);
        $period = new DatePeriod(new DateTime($start), $interval, $realEnd);
        foreach($period as $date) {
            $array[] = $date->format($format);
        }

        return $array;
    }
}
