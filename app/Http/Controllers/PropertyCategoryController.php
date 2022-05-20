<?php

namespace App\Http\Controllers;

use App\Http\Requests\PropertyCategorySaveRequest;
use App\Repositories\PropertyCategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;


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
        $categoryList = $this->propertyCategoryRepository->all();

        return view('property-category.property_category_list',compact('categoryList'));
    }
    /**
     * @param PropertyCategorySaveRequest $request
     * @return JsonResponse
     */
    public function save(PropertyCategorySaveRequest $request): JsonResponse
    {
        $category = $this->propertyCategoryRepository->save($request->input());
        if ($category) {
            return response()->json($category);
        }

        return response()->json("Some Error Your Request");
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function edit(int $id): JsonResponse
    {
        $category = $this->propertyCategoryRepository->edit($id);

        return response()->json($category);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function delete($id): JsonResponse
    {
       $this->propertyCategoryRepository->delete($id);

       return response()->json("Data Deleeted Successfully");
    }

}
