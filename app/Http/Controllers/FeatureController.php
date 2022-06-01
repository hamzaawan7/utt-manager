<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Repositories\FeatureRepositoryInterface;
use DataTables;
use Illuminate\Support\Carbon;
use App\Http\Requests\FeatureSaveRequest;

/**
 * Class FeatureController
 * @package App\Http\Controllers
 */
class FeatureController extends Controller
{
    /** @var FeatureRepositoryInterface $propertyFeatureRepository */
    private $propertyFeatureRepository;

    public function __construct(FeatureRepositoryInterface  $propertyFeatureRepository)
    {
        $this->propertyFeatureRepository = $propertyFeatureRepository;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('property.feature_list');
    }

    public function getFeatures(Request $request)
    {
        if ($request->ajax()) {
            $featureList = $this->propertyFeatureRepository->all();
            return Datatables::of($featureList)
                ->addIndexColumn()
                ->addColumn('action', function($featureList){
                    $actionBtn = '
                                  <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#"
                                   role="button" data-toggle="dropdown">
                                    <i class="dw dw-more"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                    <a class="dropdown-item reset_form" href="#" onclick="editPropertyFeature(\'/property/feature/edit/'.$featureList->id.'\')">
                                        <i class="dw dw-edit2"></i> Edit
                                    </a>
                                    <a class="dropdown-item delete-property-feature" onclick="deletePropertyFeature(\'/property/feature/delete/'.$featureList->id.'\')">
                                        <i class="dw dw-delete-3"> Delete</i>
                                    </a>
                                </div>
                            </div>';
                    return $actionBtn;
                })->editColumn('check_in_time', function($featureList){ $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $featureList->check_in_time)->format('d-m-Y H:i:s'); return $formatedDate; })
                ->editColumn('check_out_time', function($featureList){ $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $featureList->check_out_time)->format('d-m-Y H:i:s'); return $formatedDate; })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * @param FeatureSaveRequest $request
     * @return JsonResponse|void
     */
    public function save(FeatureSaveRequest $request)
    {
        $feature = $this->propertyFeatureRepository->save($request->input());
        if ($feature) {
            return response()->json([
                'status'=>200,
                'message'=>$feature
            ]);
        }
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function edit(int $id): JsonResponse
    {
        $response = $this->propertyFeatureRepository->edit($id);
//        dd($response);
        return response()->json($response);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        $response = $this->propertyFeatureRepository->delete($id);

        return response()->json($response);
    }
}
