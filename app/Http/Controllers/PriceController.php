<?php

namespace App\Http\Controllers;
use App\Models\PriceCategory;
use App\Models\Type;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Repositories\PriceRepositoryInterface;
use App\Http\Requests\PriceSaveRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

/**
 * Class PriceController
 * @package App\Http\Controllers
 */
class PriceController extends Controller
{
    /** @var PriceRepositoryInterface $priceRepository */
    private $priceRepository;
    /** @var TypePriceCategory $price */
    private $price;

    public function __construct(PriceRepositoryInterface $priceRepository)
    {
        $this->priceRepository = $priceRepository;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $category = PriceCategory::all();
        $type     = Type::all();

        return view('price.price_list',compact('category','type'));
    }

    /**
     * @param PriceSaveRequest $request
     * @return JsonResponse
     */
    public function save(PriceSaveRequest $request): JsonResponse
    {
       $message = $this->priceRepository->save($request->input());

       return response()->json([
          'status'  => 200,
          'message' => $message
       ]);
    }

    /**
     * @throws Exception
     */
    public function getPrice(Request $request)
    {
        if ($request->ajax()) {
            $price = $this->priceRepository->all();
            return Datatables::of($price)
                ->addIndexColumn()
                ->addColumn('action', function ($price) {
                    return '
                             <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#"
                                   role="button" data-toggle="dropdown">
                                    <i class="dw dw-more"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                    <a class="dropdown-item reset_form" href="#" onclick="findPrice(\'/price/find/' . $price->id . '\')">
                                        <i class="dw dw-edit2"></i> Edit
                                    </a>
                                    <a class="dropdown-item" onclick="deletePrice(\'/price/delete/' . $price->id . '\')">
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
     * @param $id
     * @return JsonResponse
     */
    public function find($id): JsonResponse
    {
        return response()->json($this->priceRepository->find($id));
    }
}