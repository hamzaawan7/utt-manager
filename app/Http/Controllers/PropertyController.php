<?php

namespace App\Http\Controllers;

use App\Models\CategoryProperty;
use App\Models\FeatureProperty;
use App\Models\NearbyProperty;
use App\Models\Property;
use App\Models\PropertyImage;
use App\Repositories\FeatureRepositoryInterface;
use App\Repositories\OwnerRepositoryInterface;
use App\Repositories\PropertyCategoryRepositoryInterface;
use App\Repositories\PropertyRepositoryInterface;
use DataTables;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\PropertySaveRequest;

/**
 * Class PropertyController
 * @package App\Http\Controllers
 */
class PropertyController extends Controller
{
    /** @var Property $property */
    /**
     * @param Property $property
     * @param FeatureProperty $feature
     * @var CategoryProperty $propertyCategory
     * @var NearbyProperty $nearbyProperty
     * @var PropertyImage $propertyImages
     */
    /** @var PropertyRepositoryInterface $propertyRepository */
    private $propertyRepository;

    /** @var OwnerRepositoryInterface $ownerRepository */
    private $ownerRepository;

    /** @var PropertyCategoryRepositoryInterface $propertyCategoryRepository */
    private $propertyCategoryRepository;

    /** @var FeatureRepositoryInterface $propertyFeatureRepository */
    private $propertyFeatureRepository;

    public function __construct(
        PropertyRepositoryInterface         $propertyRepository,
        PropertyCategoryRepositoryInterface $propertyCategoryRepository,
        FeatureRepositoryInterface          $propertyFeatureRepository,
        OwnerRepositoryInterface            $ownerRepository,
        Property                            $property,
        FeatureProperty                     $feature,
        CategoryProperty                    $propertyCategory,
        NearbyProperty                      $nearbyProperty,
        PropertyImage                       $propertyImages
    )
    {
        $this->propertyRepository         = $propertyRepository;
        $this->propertyCategoryRepository = $propertyCategoryRepository;
        $this->propertyFeatureRepository  = $propertyFeatureRepository;
        $this->ownerRepository            = $ownerRepository;
        $this->property                   = $property;
        $this->propertyCategory           = $propertyCategory;
        $this->feature                    = $feature;
        $this->nearbyProperty             = $nearbyProperty;
        $this->propertyImages             = $propertyImages;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $category     = $this->propertyCategoryRepository->all();
        $features     = $this->propertyFeatureRepository->all();
        $owners       = $this->ownerRepository->all();
        $propertyList = $this->propertyRepository->all();

        return view('property.list', compact('category', 'propertyList', 'features', 'owners'));
    }

    public function getProperty(Request $request)
    {
        if ($request->ajax()) {
            $propertyList = $this->propertyRepository->all();
            return Datatables::of($propertyList)
                ->addIndexColumn()
                ->addColumn('action', function ($propertyList) {
                    $actionBtn = '
                                  <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#"
                                   role="button" data-toggle="dropdown">
                                    <i class="dw dw-more"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                    <a class="dropdown-item reset_form" href="#" onclick="editProperty(\'/property/edit/' . $propertyList->id . '\')">
                                        <i class="dw dw-edit2"></i> Edit
                                    </a>
                                    <a class="dropdown-item btn-delete" onclick="propertyDelete(\'/property/delete/' . $propertyList->id . '\')">
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
     * @param Request $request
     * @return JsonResponse
     */
    public function save(PropertySaveRequest $request): JsonResponse
    {
        if (!is_null($request->general_id)) {
            $isVisible = 0;
            $property                   = $this->property->find($request->general_id);
            $property->name             = $request->name;
            $property->owner_id         = $request->owner_name;
            $property->short_code       = $request->short_code;
            $property->phone            = $request->phone;
            $property->address          = $request->address;
            $property->post_code        = $request->post_code;
            $property->special_category = $request->special_category;
            $property->utt_star_rating  = $request->utt_star_rating;
            if (isset($request->is_visible)){
                $isVisible = 1;
            }
            $property->is_visible       = $isVisible;
            if ($request->hasFile('main_image')) {
                $destination = public_path('images/main/' . $property->main_image);
                if (File::exists($destination)) {
                    File::delete($destination);
                }
            }
            $file      = $request->file('main_image');
            $extention = $file->getClientOriginalExtension();
            $filename  = time() . '.' . $extention;
            $file->move(public_path('images/main'), $filename);
            $property->main_image = $filename;
            $property->update();


            if ($request->has('images')) {
                foreach ($request->file('images') as $file) {
                    $extension  = $file->getClientOriginalExtension();
                    $filename   = time() . '.' . $extension;
                    $file->move(public_path('images/multiple'), $filename);
                    $propertyImages              = new $this->propertyImages;
                    $propertyImages->property_id = $request->general_id;
                    $propertyImages->images      = $filename;
                    $propertyImages->save();
                }
            }
            $this->feature->where('property_id', $request->general_id)->delete();
            $this->propertyCategory->where('property_id', $request->general_id)->delete();
            $this->nearbyProperty->where('property_id', $request->general_id)->delete();
            foreach ($request->category_name as $item) {
                $category              = new $this->propertyCategory;
                $category->property_id = $request->general_id;
                $category->category_id = $item;
                $category->save();
            }
            foreach ($request->feature_name as $item) {
                $feature              = new $this->feature;
                $feature->property_id = $request->general_id;
                $feature->feature_id  = $item;
                $feature->save();
            }
            if ($request->nearby_property) {
                foreach ($request->nearby_property as $item) {
                    $nearByProperty = new $this->nearbyProperty;
                    $nearByProperty->property_id = $request->general_id;
                    $nearByProperty->nearby_property_id = $item;
                    $nearByProperty->save();
                }
            }

            return response()->json([
                'status' => 200,
                'message' => 'Data Update Successfully'
            ]);

        } else {
            $isVisible = 0;
            $property                   = new $this->property;
            $property->name             = $request->name;
            $property->owner_id         = $request->owner_name;
            $property->short_code       = $request->short_code;
            $property->phone            = $request->phone;
            $property->address          = $request->address;
            $property->post_code        = $request->post_code;
            $property->special_category = $request->special_category;
            $property->utt_star_rating  = $request->utt_star_rating;
            if (isset($request->is_visible)){
                $isVisible = 1;
            }
            $property->is_visible       = $isVisible;
            if ($request->hasfile('main_image')) {
                $file      = $request->file('main_image');
                $extention = $file->getClientOriginalExtension();
                $filename  = time() . '.' . $extention;
                $file->move(public_path('images/main'), $filename);
                $property->main_image = $filename;
            }
            $property->save();
            $property_id = $property->id;

            if ($request->has('images')) {
                foreach ($request->file('images') as $file) {
                    $extension = $file->getClientOriginalExtension();
                    $filename  = time() . '.' . $extension;
                    $file->move(public_path('images/multiple'), $filename);
                    $propertyImages              = new $this->propertyImages;
                    $propertyImages->property_id = $property_id;
                    $propertyImages->images      = $filename;
                    $propertyImages->save();
                }
            }
            foreach ($request->category_name as $item) {
                $category              = new $this->propertyCategory;
                $category->property_id = $property_id;
                $category->category_id = $item;
                $category->save();
            }
            foreach ($request->feature_name as $item) {
                $feature              = new $this->feature;
                $feature->property_id = $property_id;
                $feature->feature_id  = $item;
                $feature->save();
            }

            if ($request->nearby_property) {
                foreach ($request->nearby_property as $item) {
                    $nearByProperty                     = new $this->nearbyProperty;
                    $nearByProperty->property_id        = $property_id;
                    $nearByProperty->nearby_property_id = $item;
                    $nearByProperty->save();
                }
            }

            return response()->json([
                'status' => 200,
                'message' => 'Data Inserted Successfully'
            ]);
        }
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function edit(int $id): JsonResponse
    {
        $property       = $this->propertyRepository->edit($id);
        $category       = array();
        $feature        = array();
        $nearbyProperty = array();

        foreach ($property->nearbyProperties as $item) {
            array_push($nearbyProperty, $item->nearby_property_id);
        }

        foreach ($property->categories as $item) {
            array_push($category, $item->id);
        }

        foreach ($property->features as $item) {
            array_push($feature, $item->id);
        }
        $property->images;
        $property->category_names     = $category;
        $property->feature_name       = $feature;
        $property->nearby_property_id = $nearbyProperty;

        return response()->json($property);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function deleteImage(int $id): JsonResponse
    {
        $propertyImages = $this->propertyImages->find($id);
        $image_path     = public_path() . '/images/multiple/' . $propertyImages->images;
        unlink($image_path);
        $propertyImages->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Images Deleted Successfully'
        ]);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function delete($id): JsonResponse
    {
        $response = $this->propertyRepository->delete($id);

        return response()->json([
            'status'=>200,
            'message'=>$response
        ]);
    }
}
