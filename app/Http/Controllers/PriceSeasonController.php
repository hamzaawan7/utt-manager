<?php

namespace App\Http\Controllers;

use App\Http\Requests\PriceSeasonSaveRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Repositories\PriceSeasonRepositoryInterface;
use Session;

/**
 * Class PriceSeasonController
 * @package App\Http\Controllers
 */
class PriceSeasonController extends Controller
{
    /** @var PriceSeasonRepositoryInterface $priceSeasonRepository */
    private $priceCategoryRepository;

    /**
     * @param PriceSeasonRepositoryInterface $priceSeasonRepository
     */
    public function __construct(PriceSeasonRepositoryInterface  $priceSeasonRepository)
    {
        $this->priceSeasonRepository = $priceSeasonRepository;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $seasons = $this->priceSeasonRepository->all();

        return view('price.price_season',compact('seasons'));
    }

    public function create()
    {
        return view('price.add_season');
    }

    /**
     * @param PriceSeasonSaveRequest $request
     * @return RedirectResponse
     */
    public function save(PriceSeasonSaveRequest $request): RedirectResponse
    {
        $response = $this->priceSeasonRepository->save($request->input());

        if ($response){
            return redirect()->route('price-season-list')->with('message','Data Save Successfully');
        }

        return redirect()->route('price-season-list')->with('error','Error While Save Data');
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
       $season =  $this->priceSeasonRepository->edit($id);
       $season->from_date = date('y/m/d', strtotime($season->from_date));
       $season->to_date   = date('y/m/d', strtotime($season->to_date));

       return view('price.edit_season',compact('season'));
    }

    /**
     * @param PriceSeasonSaveRequest $request
     * @return RedirectResponse
     */
    public function update(PriceSeasonSaveRequest $request): RedirectResponse
    {
        $response = $this->priceSeasonRepository->update($request->input());
        if ($response){
            return redirect()->route('price-season-list')->with('message','Data Updated Successfully');
        }

        return redirect()->route('price-season-list')->with('error','Error While Update Data');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function delete($id): RedirectResponse
    {
       $response = $this->priceSeasonRepository->delete($id);

       return redirect()->route('price-season-list')->with('message','Data Deleted Successfully');
    }
}
