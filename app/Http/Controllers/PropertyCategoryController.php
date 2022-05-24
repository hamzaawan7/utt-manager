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
use Illuminate\Routing\Controller;

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
        $categoryList = $this->propertyCategoryRepository->all();

        return view('property.category_list',compact('categoryList'));
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

        return response()->json("Error Your Request");
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
     * @param PropertyCategorySaveRequest $request
     * @return RedirectResponse
     */
    public function update(PropertyCategorySaveRequest $request): RedirectResponse
    {
       $response = $this->propertyCategoryRepository->update($request->input());
        if ($response) {
            return redirect()->route('propert-category-list')->with('message','Data Updated Successfully');
        }

        return redirect()->route('propert-category-list')->with('error','Error While Update Data');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function delete($id): RedirectResponse
    {
        $this->propertyCategoryRepository->delete($id);

        return redirect()->route('propert-category-list')->with('message','Data Deleted Successfully');
    }

}
