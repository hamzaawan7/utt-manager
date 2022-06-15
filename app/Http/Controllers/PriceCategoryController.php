<?php

namespace App\Http\Controllers;

use App\Http\Requests\PriceCategorySaveRequest;
use App\Repositories\PriceCategoryRepositoryInterface;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

/**
 * Class PriceCategoryController
 * @package App\Http\Controllers
 */
class PriceCategoryController extends Controller
{
    /** @var PriceCategoryRepositoryInterface $priceCategoryRepository */
    private $priceCategoryRepository;

    public function __construct(PriceCategoryRepositoryInterface $priceCategoryRepository)
    {
        $this->priceCategoryRepository = $priceCategoryRepository;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $categories = $this->priceCategoryRepository->all();

        return view('price.price_category_list',compact('categories'));
    }

    /**
     * @throws Exception
     */
    public function getPriceCategory(Request $request)
    {
        if ($request->ajax()) {
            $priceCategories = $this->priceCategoryRepository->all();
            return Datatables::of($priceCategories)
                ->addIndexColumn()
                ->addColumn('action', function ($priceCategories) {
                    return '
                             <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#"
                                   role="button" data-toggle="dropdown">
                                    <i class="dw dw-more"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                    <a class="dropdown-item reset_form" href="#" onclick="findPriceCategory(\'/price/category/find/' . $priceCategories->id . '\')">
                                        <i class="dw dw-edit2"></i> Edit
                                    </a>
                                    <a class="dropdown-item" onclick="deletePriceCategory(\'/price/category/delete/' . $priceCategories->id . '\')">
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
     * @param PriceCategorySaveRequest $request
     * @return JsonResponse
     */
    public function save(PriceCategorySaveRequest $request): JsonResponse
    {
        $message = $this->priceCategoryRepository->save($request->input());

        return response()->json([
            'status'  => 200,
            'message' => $message
        ]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function find(int $id): JsonResponse
    {
        return response()->json($this->priceCategoryRepository->find($id));
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function delete($id): JsonResponse
    {
        $message = $this->priceCategoryRepository->delete($id);

        return response()->json([
            'status'  => 200,
            'message' => $message
        ]);
    }
}
