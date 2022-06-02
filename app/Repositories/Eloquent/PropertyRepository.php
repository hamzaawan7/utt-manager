<?php

namespace App\Repositories\Eloquent;
use App\Repositories\PropertyRepositoryInterface;
use App\Models\Property;
use App\Models\CategoryProperty;
use App\Models\FeatureProperty;
use App\Models\NearbyProperty;

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
     */
    public function __construct(
        Property                 $property,
        FeatureProperty          $feature,
        CategoryProperty $propertyCategory,
        NearbyProperty $nearbyProperty

    )
    {
        $this->property         = $property;
        $this->propertyCategory = $propertyCategory;
        $this->feature          = $feature;
        $this->nearbyProperty  = $nearbyProperty;
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
    public function edit(int $id)
    {
        return $this->property->find($id);
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->property::all();
    }

    /**
     * @return void
     */
    public function get()
    {
        // TODO: Implement get() method.
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id)
    {
        try {
            $this->feature->where('property_id', $id)->delete();
            $this->propertyCategory->where('property_id', $id)->delete();
            $this->nearbyProperty->where('property_id', $id)->delete();
            $this->property->find($id)->delete();

            return "Data Deleted Successfully";
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
