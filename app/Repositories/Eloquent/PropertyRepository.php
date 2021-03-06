<?php

namespace App\Repositories\Eloquent;
use App\Repositories\PropertyRepositoryInterface;
use App\Models\Property;
use App\Models\CategoryProperty;
use App\Models\FeatureProperty;
use App\Models\NearbyProperty;
use App\Models\PropertyImage;
use App\Models\OwnerProperty;
use App\Models\StarRating;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class PropertyRepository
 * @package App\Repositories\Eloquent
 */
class PropertyRepository implements PropertyRepositoryInterface
{
    /** @var Property $property */
    /**
     * @var Property
     */
    private $property;
    /**
     * @var CategoryProperty
     */

    private $starRating;
    /**
     * @var StarRating
     */

    private $propertyCategory;
    /**
     * @var PropertyImage
     */
    private $imageProperty;
    /**
     * @var FeatureProperty
     */
    private $feature;
    /**
     * @var NearbyProperty
     */
    private $nearbyProperty;
    /**
     * @var OwnerProperty
     */
    private $ownerProperty;

    /**
     * @param Property $property
     * @param FeatureProperty $feature
     * @var CategoryProperty $propertyCategory
     * @var NearbyProperty $nearbyProperty
     * @var PropertyImage $imageProperty
     * @var StarRating $starRating
     * @var OwnerProperty $ownerProperty
     */
    public function __construct(
        Property                 $property,
        FeatureProperty          $feature,
        CategoryProperty $propertyCategory,
        NearbyProperty $nearbyProperty,
        PropertyImage $imageProperty,
        StarRating $starRating,
        OwnerProperty $ownerProperty

    )
    {
        $this->property         = $property;
        $this->propertyCategory = $propertyCategory;
        $this->feature          = $feature;
        $this->nearbyProperty   = $nearbyProperty;
        $this->imageProperty    = $imageProperty;
        $this->starRating       = $starRating;
        $this->ownerProperty       = $ownerProperty;
    }

    /**
     * @param $data
     * @return void
     */
    public function save($data)
    {

    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getPropertyWithRelationship(int $id)
    {
        return $this->property->where('id', $id)->with('categories','starRatings','features','images','nearbyProperties','owners')->first();
    }

    /**
     * @return Collection|Property[]
     */
    public function all()
    {
        return $this->property->all();
    }

    /**
     * @param int $id
     * @return string
     */
    public function delete(int $id): string
    {
        try {
            $this->feature->where('property_id', $id)->delete();
            $this->propertyCategory->where('property_id', $id)->delete();
            $this->imageProperty->where('property_id', $id)->delete();
            $this->nearbyProperty->where('property_id', $id)->delete();
            $this->nearbyProperty->where('property_id', $id)->delete();
            $this->starRating->where('property_id', $id)->delete();
            $this->ownerProperty->where('property_id', $id)->delete();
            $this->property->find($id)->delete();

            return "Data Deleted Successfully";
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
