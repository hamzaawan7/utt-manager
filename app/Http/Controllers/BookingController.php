<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerBookingSaveRequest;
use App\Models\Booking;
use App\Models\Property;
use App\Repositories\CustomerBookingRepositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
     * @var Property
     */
    private $property;

    /**
     * @param CustomerBookingRepositoryInterface $customerBookingRepository
     * @param Booking $booking
     * @param Property $property
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

        $payments = $this->booking->where('status', '!=', 'Owner Booking')->get();

        return view('booking.booking_detail', compact('bookings','payments'));
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

    /**
     * @return Application|Factory|View
     */
    public function cleaningRotaList()
    {
        $property = Property::all();

        return view('booking.cleaning_rota_list',compact('property'));
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getCleaningRota(int $id)
    {
        return $this->property->where('id', $id)->with('cleaningRotas')->get();
    }

    public function getPaymentDetail(Request $request)
    {
        if ($request->ajax()) {
            $payments = $this->booking->where('status', '!=', 'Owner Booking')->get();
            return Datatables::of($payments)
                ->addIndexColumn()
                ->addColumn('action', function ($payments) {
                    return '
                            <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#"
                                   role="button" data-toggle="dropdown">
                                    <i class="dw dw-more"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                    <a class="dropdown-item reset_form" href="#" onclick="findBookingPayment(\'/booking/payment/find/' . $payments->id . '\')">
                                        <i class="dw dw-edit2"></i> Edit
                                    </a>
                                    <a class="dropdown-item btn-delete" onclick="deleteBookingPayment(\'/booking/payment/delete/' . $payments->id . '\')">
                                        <i class="dw dw-delete-3"> Delete</i>
                                    </a>
                                </div>
                            </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function findPayment($id)
    {
        $findBookingPayment = $this->booking->find($id);

        return response()->json($findBookingPayment);
    }

    public function bookingConfiramtion()
    {
        $bookingConsirmation = $this->booking->where('status', '=','Fully Paid')->get();

        return view('booking.booking_confirmation',compact('bookingConsirmation'));
    }
}
