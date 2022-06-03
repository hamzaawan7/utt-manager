<?php

namespace App\Http\Controllers;

use App\Http\Requests\PropertyCategorySaveRequest;
use App\Repositories\PropertyCategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use DataTables;


/**
 * Class PropertyCategoryController
 * @package App\Http\Controllers
 */
class PropertyCategoryController extends Controller
{
    /** @var PropertyCategoryRepositoryInterface $propertyCategoryRepository */
    private $propertyCategoryRepository;

    public function __construct(PropertyCategoryRepositoryInterface  $propertyCategoryRepository)
    {
        $this->propertyCategoryRepository = $propertyCategoryRepository;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('property.category_list');
    }

    /**
     * @param Request $request
     * @return void
     */
    public function getCategory(Request $request)
    {
        if ($request->ajax()) {
            $categoryList = $this->propertyCategoryRepository->all();
            return Datatables::of($categoryList)
                ->addIndexColumn()
                ->addColumn('action', function($categoryList){
                    $actionBtn = '
                                  <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#"
                                   role="button" data-toggle="dropdown">
                                    <i class="dw dw-more"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                    <a class="dropdown-item reset_form" href="#" onclick="findPropertyCategory(\'/category/find/'.$categoryList->id.'\')">
                                        <i class="dw dw-edit2"></i> Edit
                                    </a>
                                    <a class="dropdown-item btn-delete" onclick="deletePropertyCategory(\'/category/delete/'.$categoryList->id.'\')">
                                        <i class="dw dw-delete-3"> Delete</i>
                                    </a>
                                </div>
                            </div>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * @param PropertyCategorySaveRequest $request
     * @return JsonResponse
     */
    public function save(PropertyCategorySaveRequest $request): JsonResponse
    {
        $message = $this->propertyCategoryRepository->save($request->input());

            return response()->json([
                'status'=>200,
                 'message'=>$message
            ]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function find(int $id): JsonResponse
    {
        $category = $this->propertyCategoryRepository->find($id);

        return response()->json($category);

    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function delete($id): JsonResponse
    {
        $message = $this->propertyCategoryRepository->delete($id);

        return response()->json([
            'status' => 200,
            'message' => $message
        ]);
    }
}
