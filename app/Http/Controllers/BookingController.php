<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerBookingSaveRequest;
use App\Http\Requests\OwnerBookingSaveRequest;
use App\Models\Booking;
use App\Models\Property;
use App\Repositories\CustomerBookingRepositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class BookingController
 * @package App\Http\Controllers
 */
class BookingController extends Controller
{
    /**
     * @var CustomerBookingRepositoryInterface
     */
    private $customerBookingRepository;
    /**
     * @var Booking
     */
    private $booking;
    /**
     * @var Property
     */
    private $property;

    /**
     * @param CustomerBookingRepositoryInterface $customerBookingRepository
     * @param Booking $booking
     */
    public function __construct(
        CustomerBookingRepositoryInterface $customerBookingRepository,
        Booking $booking,
        Property $property
    )
    {
        $this->customerBookingRepository = $customerBookingRepository;
        $this->booking  = $booking;
        $this->property = $property;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $bookings = $this->booking
            ->join('properties', 'properties.id', '=', 'bookings.property_id')
            ->select('properties.*', 'bookings.*')
            ->get();

        return view('booking.booking_detail', compact('bookings'));
    }

    /**
     * @param CustomerBookingSaveRequest $request
     * @return JsonResponse
     */
    public function save(CustomerBookingSaveRequest $request): JsonResponse
    {
        return $this->customerBookingRepository->save($request->input());
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function ownerSave(Request $request): JsonResponse
    {
        return $this->customerBookingRepository->save($request->input());
    }

    public function cleaningRotaList()
    {
        $property = Property::all();

        return view('booking.cleaning_rota_list',compact('property'));
    }

    public function getCleaningRota(int $id)
    {
        $data = $this->property->where('id', $id)->with('bookings')->get();

        return $data;
    }
}
