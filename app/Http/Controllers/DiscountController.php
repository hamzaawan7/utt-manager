<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiscountSaveRequest;
use App\Models\Property;
use App\Repositories\DiscountRepositoryInterface;
use Exception;
use http\Env\Response;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

/**
 * Class DiscountController
 * @package App\Http\Controllers
 */
class DiscountController extends Controller
{
    /**
     * @var DiscountRepositoryInterface
     */
    private $discountRepository;

    public function __construct(
        DiscountRepositoryInterface $discountRepository
    )
    {
        $this->discountRepository = $discountRepository;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $property = Property::all();

        return view('discount.discount_list', compact('property'));
    }

    /**
     * @param Request $request
     * @return void
     * @throws Exception
     */
    public function getDiscount(Request $request)
    {
        if ($request->ajax()) {
            $discountList = $this->discountRepository->all();
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
                                    <a class="dropdown-item reset_form" href="#" onclick="findDiscount(\'/discount/find/' . $discountList->id . '\')">
                                        <i class="dw dw-edit2"></i> Edit
                                    </a>
                                    <a class="dropdown-item" onclick="deleteDiscount(\'/discount/delete/' . $discountList->id . '\')">
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
     * @param DiscountSaveRequest $request
     * @return JsonResponse
     */
    public function save(DiscountSaveRequest $request): JsonResponse
    {
        $message = $this->discountRepository->save($request->input());

        return response()->json([
            'status' => 200,
            'message' => $message
        ]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function find(int $id): JsonResponse
    {
        return response()->json($this->discountRepository->find($id));
    }

    public function delete(int $id)
    {
        $this->discountRepository->delete($id);
    }
}
