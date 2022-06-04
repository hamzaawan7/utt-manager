<?php

namespace App\Repositories\Eloquent;
use App\Repositories\PropertyRepositoryInterface;
use App\Models\Property;
use App\Models\CategoryProperty;
use App\Models\FeatureProperty;
use App\Models\NearbyProperty;
use App\Models\PropertyImage;
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
     * @param Property $property
     * @param FeatureProperty $feature
     * @var CategoryProperty $propertyCategory
     * @var NearbyProperty $nearbyProperty
     * @var PropertyImage $imageProperty
     */
    public function __construct(
        Property                 $property,
        FeatureProperty          $feature,
        CategoryProperty $propertyCategory,
        NearbyProperty $nearbyProperty,
        PropertyImage $imageProperty

    )
    {
        $this->property         = $property;
        $this->propertyCategory = $propertyCategory;
        $this->feature          = $feature;
        $this->nearbyProperty  = $nearbyProperty;
        $this->imageProperty  = $imageProperty;
    }

    /**
     * @param $data
     * @return mixed
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
        return $this->property->where('id', $id)->with('images','nearbyProperties','features','categories')->get();
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
            $this->property->find($id)->delete();

            return "Data Deleted Successfully";
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
