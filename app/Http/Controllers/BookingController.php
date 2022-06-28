<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerBookingSaveRequest;
use App\Models\Booking;
use App\Models\Customer;
use App\Repositories\CustomerBookingRepositoryInterface;
use GuzzleHttp\Psr7\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;

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
     * @var Customer
     */
    private $customer;

    /**
     * @param CustomerBookingRepositoryInterface $customerBookingRepository
     * @param Booking $booking
     * @param Customer $customer
     */
    public function __construct(
        CustomerBookingRepositoryInterface $customerBookingRepository,
        Booking                            $booking,
        Customer                           $customer
    )
    {
        $this->customerBookingRepository = $customerBookingRepository;
        $this->booking = $booking;
        $this->customer = $customer;
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
}
