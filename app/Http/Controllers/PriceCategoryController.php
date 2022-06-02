<?php

namespace App\Http\Controllers;

use App\Http\Requests\PriceCategorySaveRequest;
use App\Repositories\PriceCategoryRepositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * Class PriceCategoryController
 * @package App\Http\Controllers
 */
class PriceCategoryController extends Controller
{
    /** @var PriceCategoryRepositoryInterface $priceCategoryRepository */
    private $priceCategoryRepository;

    public function __construct(PriceCategoryRepositoryInterface  $priceCategoryRepository)
    {
        $this->priceCategoryRepository = $priceCategoryRepository;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $priceCategories = $this->priceCategoryRepository->all();

        return view('price.price_category_list',compact('priceCategories'));
    }

    public function create()
    {
        return view('price.add_category');
    }

    /**
     * @param PriceCategorySaveRequest $request
     * @return RedirectResponse
     */
    public function save(PriceCategorySaveRequest $request): RedirectResponse
    {
        $response = $this->priceCategoryRepository->save($request->input());
        if ($response) {
            return redirect()->route('price-category-list')->with('message','Data Inserted Successfully');
        }

        return redirect()->route('price-category-list')->with('error','Error While Saving Data');

    }

    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $category = $this->priceCategoryRepository->edit($id);

        return view('price.edit_category',compact('category'));
    }

    public function update(PriceCategorySaveRequest $request)
    {
        $response = $this->priceCategoryRepository->update($request->input());

        if ($response) {
            return redirect()->route('price-category-list')->with('message','Data Updated Successfully');
        }

        return redirect()->route('price-category-list')->with('error','Error While Saving Data');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function delete($id): RedirectResponse
    {
        $this->priceCategoryRepository->delete($id);

        return redirect()->route('price-category-list')->with('message','Data Deleted Successfully');
    }
}
