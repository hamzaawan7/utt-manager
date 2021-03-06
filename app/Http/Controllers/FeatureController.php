<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeatureSaveRequest;
use App\Repositories\FeatureRepositoryInterface;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;

/**
 * Class FeatureController
 * @package App\Http\Controllers
 */
class FeatureController extends Controller
{
    /** @var FeatureRepositoryInterface $propertyFeatureRepository */
    private $propertyFeatureRepository;

    public function __construct(FeatureRepositoryInterface $propertyFeatureRepository)
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

    /**
     * @param Request $request
     * @return void
     * @throws Exception
     */
    public function getFeatures(Request $request)
    {
        if ($request->ajax()) {
            $featureList = $this->propertyFeatureRepository->all();
            return Datatables::of($featureList)
                ->addIndexColumn()
                ->addColumn('action', function ($featureList) {
                    return '
                            <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#"
                                   role="button" data-toggle="dropdown"
                                >
                                    <i class="dw dw-more"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                    <a class="dropdown-item reset_form" href="#" onclick="findPropertyFeature(\'/property/feature/find/' . $featureList->id . '\')">
                                        <i class="dw dw-edit2"></i> Edit
                                    </a>
                                    <a class="dropdown-item delete-property-feature" onclick="deletePropertyFeature(\'/property/feature/delete/' . $featureList->id . '\')">
                                        <i class="dw dw-delete-3"> Delete</i>
                                    </a>
                                </div>
                            </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * @param FeatureSaveRequest $request
     * @return JsonResponse
     */
    public function save(FeatureSaveRequest $request)
    {
        return $this->propertyFeatureRepository->save($request->input());
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function find(int $id): JsonResponse
    {
        $response = $this->propertyFeatureRepository->find($id);

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
