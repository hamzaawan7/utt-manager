<?php

namespace App\Http\Controllers;

use App\Http\Requests\PropertySaveRequest;
use App\Models\CategoryProperty;
use App\Models\FeatureProperty;
use App\Models\NearbyProperty;
use App\Models\PriceCategory;
use App\Models\OwnerProperty;
use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\Season;
use App\Models\StarRating;
use App\Repositories\FeatureRepositoryInterface;
use App\Repositories\OwnerRepositoryInterface;
use App\Repositories\PropertyCategoryRepositoryInterface;
use App\Repositories\PropertyRepositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;

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
     * @var OwnerProperty $ownerProperty
     */
    /** @var PropertyRepositoryInterface $propertyRepository */
    private $propertyRepository;

    /** @var OwnerRepositoryInterface $ownerRepository */
    private $ownerRepository;

    /** @var PropertyCategoryRepositoryInterface $propertyCategoryRepository */
    private $propertyCategoryRepository;

    /** @var FeatureRepositoryInterface $propertyFeatureRepository */
    private $propertyFeatureRepository;
    /**
     * @var Property
     */
    private $property;
    /**
     * @var CategoryProperty
     */
    private $propertyCategory;
    /**
     * @var FeatureProperty
     */
    private $feature;
    /**
     * @var NearbyProperty
     */
    private $nearbyProperty;
    /**
     * @var PropertyImage
     */
    private $propertyImages;
    /**
     * @var OwnerProperty
     */
    private $ownerProperty;

    public function __construct(
        PropertyRepositoryInterface         $propertyRepository,
        PropertyCategoryRepositoryInterface $propertyCategoryRepository,
        FeatureRepositoryInterface          $propertyFeatureRepository,
        OwnerRepositoryInterface            $ownerRepository,
        Property                            $property,
        FeatureProperty                     $feature,
        CategoryProperty                    $propertyCategory,
        NearbyProperty                      $nearbyProperty,
        PropertyImage                       $propertyImages,
        OwnerProperty                       $ownerProperty
    )
    {
        $this->propertyRepository = $propertyRepository;
        $this->propertyCategoryRepository = $propertyCategoryRepository;
        $this->propertyFeatureRepository = $propertyFeatureRepository;
        $this->ownerRepository = $ownerRepository;
        $this->property = $property;
        $this->propertyCategory = $propertyCategory;
        $this->feature = $feature;
        $this->nearbyProperty = $nearbyProperty;
        $this->propertyImages = $propertyImages;
        $this->ownerProperty = $ownerProperty;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $category = $this->propertyCategoryRepository->all();
        $features = $this->propertyFeatureRepository->all();
        $owners = $this->ownerRepository->all();
        $propertyList = $this->propertyRepository->all();

        return view('property.list', compact('category', 'propertyList', 'features', 'owners'));
    }

    /**
     * @return Application|Factory|View
     */
    public function addProperty()
    {
        $category      = $this->propertyCategoryRepository->all();
        $features      = $this->propertyFeatureRepository->all();
        $owners        = $this->ownerRepository->all();
        $propertyList  = $this->propertyRepository->all();
        $seasonList    = Season::all();
        $priceCategory = PriceCategory::all();

        return view('property.add_property', compact('category', 'priceCategory', 'seasonList', 'features', 'owners', 'propertyList'));
    }

    /**
     * @param PropertySaveRequest $request
     * @return RedirectResponse
     */
    public function save(PropertySaveRequest $request): RedirectResponse
    {
        if (!is_null($request->property_id)) {
            $property = $this->property->find($request->property_id);
            $property = $this->getCommonFields($property, $request);


            if ($request->hasFile('main_image')) {
                $destination = public_path('images/main/' . $property->main_image);
                if (File::exists($destination)) {
                    File::delete($destination);
                }
                $file = $request->file('main_image');
                $extention = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extention;
                $file->move(public_path('images/main'), $filename);
                $property->main_image = $filename;
            }
            $property->update();

            $starRating = StarRating::where('id', $request->property_id)->update([
                'star_rating_luxury' => $request->star_rating_luxury,
                'star_rating_heritage' => $request->star_rating_heritage,
                'star_rating_unique' => $request->star_rating_unique,
                'star_rating_green' => $request->star_rating_green,
                'star_rating_price' => $request->star_rating_price,
            ]);

            if ($request->file('images')) {
                foreach ($request->file('images') as $file) {
                    $name = time() . rand(1, 100) . '.' . $file->extension();
                    $file->move(public_path('/images/multiple/'), $name);
                    $propertyImages = new $this->propertyImages;
                    $propertyImages->images = $name;
                    $propertyImages->property_id = $request->property_id;
                    $propertyImages->save();
                }
            }
            $this->feature->where('property_id', $request->property_id)->delete();
            $this->propertyCategory->where('property_id', $request->property_id)->delete();
            $this->nearbyProperty->where('property_id', $request->property_id)->delete();
            $this->ownerProperty->where('property_id', $request->property_id)->delete();

            if ($request->category_name) {
                foreach ($request->category_name as $item) {
                    $category              = new $this->propertyCategory;
                    $category->property_id = $request->property_id;
                    $category->category_id = $item;
                    $category->save();
                }
            }

            if ($request->feature_name) {
                foreach ($request->feature_name as $item) {
                    $feature              = new $this->feature;
                    $feature->property_id = $request->property_id;
                    $feature->feature_id  = $item;
                    $feature->save();
                }
            }

            if ($request->nearby_property) {
                foreach ($request->nearby_property as $item) {
                    $nearByProperty                     = new $this->nearbyProperty;
                    $nearByProperty->property_id        = $request->property_id;
                    $nearByProperty->nearby_property_id = $item;
                    $nearByProperty->save();
                }
            }

            if ($request->owner_name) {
                foreach ($request->owner_name as $item) {
                    $ownerProperty              = new $this->ownerProperty;
                    $ownerProperty->property_id = $request->property_id;
                    $ownerProperty->owner_id    = $item;
                    $ownerProperty->save();
                }
            }

            return redirect()->route('property-list')->with('message', 'Data Updated Successfully');
        } else {
            $property = new $this->property;
            $property = $this->getCommonFields($property, $request);
            if ($request->hasfile('main_image')) {
                $file      = $request->file('main_image');
                $extension = $file->getClientOriginalExtension();
                $filename  = time() . '.' . $extension;
                $file->move(public_path('images/main'), $filename);
                $property->main_image = $filename;
            }
            $property->save();
            $property_id = $property->id;

            $starRating = new StarRating;
            $starRating->property_id          = $property_id;
            $starRating->star_rating_luxury   = $request->star_rating_luxury;
            $starRating->star_rating_heritage = $request->star_rating_heritage;
            $starRating->star_rating_unique   = $request->star_rating_unique;
            $starRating->star_rating_green    = $request->star_rating_green;
            $starRating->star_rating_price    = $request->star_rating_price;
            $starRating->save();

            if ($request->file('images')) {
                foreach ($request->file('images') as $file) {
                    $name = time() . rand(1, 100) . '.' . $file->extension();
                    $file->move(public_path('/images/multiple/'), $name);
                    $propertyImages = new $this->propertyImages;
                    $propertyImages->images = $name;
                    $propertyImages->property_id = $property_id;
                    $propertyImages->save();
                }
            }

            if ($request->category_name) {
                foreach ($request->category_name as $item) {
                    $category = new $this->propertyCategory;
                    $category->property_id = $property_id;
                    $category->category_id = $item;
                    $category->save();
                }
            }

            if ($request->feature_name) {
                foreach ($request->feature_name as $item) {
                    $feature = new $this->feature;
                    $feature->property_id = $property_id;
                    $feature->feature_id = $item;
                    $feature->save();
                }
            }

            if ($request->nearby_property) {
                foreach ($request->nearby_property as $item) {
                    $nearByProperty = new $this->nearbyProperty;
                    $nearByProperty->property_id = $property_id;
                    $nearByProperty->nearby_property_id = $item;
                    $nearByProperty->save();
                }
            }

            if ($request->owner_name) {
                foreach ($request->owner_name as $item) {
                    $ownerProperty = new $this->ownerProperty;
                    $ownerProperty->property_id = $property_id;
                    $ownerProperty->owner_id = $item;
                    $ownerProperty->save();
                }
            }

            return redirect()->route('property-list')->with('message', 'Data Saved Successfully');
        }
    }

    /**
     * @param $property
     * @param $request
     * @return mixed
     */
    public function getCommonFields($property, $request)
    {
        $isVisible = 0;
        $sevenNightStay = 0;
        $property->name = $request->name;
        $property->season_id = $request->season_id;
        $property->price_category_id = $request->price_category_id;
        $property->short_code = $request->short_code;
        $property->phone = $request->phone;
        $property->address = $request->address;
        $property->post_code = $request->post_code;
        $property->special_category = $request->special_category;
        $property->standard_guests = $request->standard_guests;
        $property->minimum_guest = $request->minimum_guest;
        $property->room_layouts = $request->room_layouts;
        $property->check_in_time = dateFormat($request->check_in_time);
        $property->check_out_time = dateFormat($request->check_out_time);
        $property->minimum_nights = $request->minimum_nights;
        $property->childs = $request->childs;
        $property->infants = $request->infants;
        $property->pets = $request->pets;
        $property->special_start_days = dateFormat($request->special_start_days);
        $property->bank_account_number = $request->bank_account_number;
        $property->main_contact_name = $request->main_contact_name;
        $property->main_contact_number = $request->main_contact_number;
        $property->secondary_contact_name = $request->secondary_contact_name;
        $property->secondary_contact_number = $request->secondary_contact_number;
        $property->emergency_contact_name = $request->emergency_contact_name;
        $property->emergency_contact_number = $request->emergency_contact_number;
        $property->cleaning_rota_receipts = $request->cleaning_rota_receipts;
        if (isset($request->is_visible)) {
            $isVisible = 1;
        }
        if (isset($request->min_seven_night_stay)) {
            $sevenNightStay = 1;
        }
        $property->is_visible = $isVisible;
        $property->min_seven_night_stay = $sevenNightStay;

        return $property;
    }

    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function find(int $id)
    {
        $property   = $this->propertyRepository->getPropertyWithRelationship($id);
        $categories = [];
        $features   = [];
        $owners     = [];
        $nearbyProperties = [];
        if (!empty($property->categories)) {
            foreach ($property->categories as $item) {
                $categories[] = $item->id;
            }
        }

        if (!empty($property->owners)) {
            foreach ($property->owners as $item) {
                $owners[] = $item->owner_id;
            }
        }

        if (!empty($property->features)) {
            foreach ($property->features as $item) {
                $features[] = $item->id;
            }
        }

        if (!empty($property->nearbyProperties)) {
            foreach ($property->nearbyProperties as $item) {
                $nearbyProperties[] = $item->nearby_property_id;
            }
        }

        $property->categories       = $categories;
        $property->features         = $features;
        $property->owners           = $owners;
        $property->nearbyProperties = $nearbyProperties;
        $category                   = $this->propertyCategoryRepository->all();
        $features                   = $this->propertyFeatureRepository->all();
        $owners                     = $this->ownerRepository->all();
        $propertyList               = $this->propertyRepository->all();
        $seasonList                 = Season::all();
        $priceCategory              = PriceCategory::all();
        $starRating                 = StarRating::all();

        return view('property.edit_property', compact('property', 'starRating', 'priceCategory', 'propertyList', 'category', 'owners', 'features', 'seasonList'));
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
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        $message = $this->propertyRepository->delete($id);

        return redirect()->route('property-list')->with('message', $message);
    }
}
