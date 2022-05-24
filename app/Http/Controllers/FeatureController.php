<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Repositories\FeatureRepositoryInterface;

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
        $featureList = $this->propertyFeatureRepository->all();

        return view('property.feature_list',compact('featureList'));
    }

    /**
     * @param Request $request
     * @return JsonResponse|void
     */
    public function save(Request $request)
    {
        $category = $this->propertyFeatureRepository->save($request->input());
        if ($category) {
            return response()->json($category);
        }
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function edit(int $id): JsonResponse
    {
        $response = $this->propertyFeatureRepository->edit($id);

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
