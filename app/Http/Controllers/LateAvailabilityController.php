<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Repositories\LateAvailabilityRepositoryInterface;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

/**
 * Class LateAvailabilityController
 * @package App\Http\Controllers
 */
class LateAvailabilityController extends Controller
{
    /**
     * @var LateAvailabilityRepositoryInterface
     */
    private $lateAvailabilityRepository;
    private $discountRepository;

    public function __construct(LateAvailabilityRepositoryInterface $lateAvailabilityRepository)
    {
        $this->lateAvailabilityRepository = $lateAvailabilityRepository;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $property = Property::all();

        return view('lateavailability.late_availability_list', compact('property'));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function save(Request $request)
    {
        $message = $this->lateAvailabilityRepository->save($request->input());

        return response()->json([
            'status' => 200,
            'message' => $message
        ]);
    }

    /**
     * @param Request $request
     * @return void
     * @throws Exception
     */
    public function getLateAvailability(Request $request)
    {
        if ($request->ajax()) {
            $discountList = $this->lateAvailabilityRepository->all();
            return Datatables::of($discountList)
                ->addIndexColumn()
                ->addColumn('action', function ($discountList) {
                    return '
                             <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#"
                                   role="button" data-toggle="dropdown">
                                    <i class="dw dw-more"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                    <a class="dropdown-item reset_form" href="#" onclick="findlateAvailability(\'/late/availability/find/' . $discountList->id . '\')">
                                        <i class="dw dw-edit2"></i> Edit
                                    </a>
                                    <a class="dropdown-item" onclick="deleteLateAvailability(\'/late/availability/delete/' . $discountList->id . '\')">
                                        <i class="dw dw-delete-3" style="cursor: pointer;"> Delete</i>
                                    </a>
                                </div>
                            </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function find(int $id): JsonResponse
    {
        return response()->json($this->lateAvailabilityRepository->find($id));
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        $message = $this->lateAvailabilityRepository->delete($id);

        return response()->json([
            'status' => 200,
            'message' => $message
        ]);
    }
}
