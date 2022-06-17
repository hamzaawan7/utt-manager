<?php

namespace App\Http\Controllers;

use App\Http\Requests\PriceSeasonSaveRequest;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use App\Repositories\PriceSeasonRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Type;
use Yajra\DataTables\DataTables;

/**
 * Class PriceSeasonController
 * @package App\Http\Controllers
 */
class PriceSeasonController extends Controller
{
    /** @var PriceSeasonRepositoryInterface $priceSeasonRepository */
    private $priceCategoryRepository;
    /**
     * @var PriceSeasonRepositoryInterface
     */
    private $priceSeasonRepository;

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
        $type = Type::all();

        return view('price.price_season_list',compact('type'));
    }

    /**
     * @param Request $request
     * @return void
     * @throws Exception
     */
    public function getSeason(Request $request)
    {
        if ($request->ajax()) {
            $seasons = $this->priceSeasonRepository->all();
            return Datatables::of($seasons)
                ->addIndexColumn()
                ->addColumn('action', function ($seasons) {
                    return '
                            <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#"
                                   role="button" data-toggle="dropdown"
                                >
                                    <i class="dw dw-more"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                    <a class="dropdown-item reset_form" href="#" onclick="findPriceSeason(\'/price/season/find/' . $seasons->id . '\')">
                                        <i class="dw dw-edit2"></i> Edit
                                    </a>
                                    <a class="dropdown-item delete-property-feature" onclick="deletePriceSeason(\'/price/season/delete/' . $seasons->id . '\')">
                                        <i class="dw dw-delete-3" style="cursor: pointer;"> Delete</i>
                                    </a>
                                </div>
                            </div>';
                })->editColumn('from_date', function ($seasons) {
                    return Carbon::createFromFormat('Y-m-d H:i:s', $seasons->from_date)->format('d-m-Y H:i:s');
                })
                ->editColumn('to_date', function ($seasons) {
                    return Carbon::createFromFormat('Y-m-d H:i:s', $seasons->to_date)->format('d-m-Y H:i:s');
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * @param PriceSeasonSaveRequest $request
     * @return JsonResponse
     */
    public function save(PriceSeasonSaveRequest $request): JsonResponse
    {
        $message = $this->priceSeasonRepository->save($request->input());

        return response()->json([
            'status' => 200,
            'message' => $message
        ]);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function find($id): JsonResponse
    {
       return response()->json($this->priceSeasonRepository->find($id));
    }
    
    /**
     * @param $id
     * @return JsonResponse
     */
    public function delete($id): JsonResponse
    {
       $message = $this->priceSeasonRepository->delete($id);

       return response()->json([
             'status'=> 200,
              'message'=> $message
       ]);
    }
}
