<?php

namespace App\Repositories\Eloquent;

use App\Models\Discount;
use App\Models\DiscountProperty;
use App\Models\Property;
use App\Repositories\LateAvailabilityRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class LateAvailabilityRepository implements LateAvailabilityRepositoryInterface
{
    /**
     * @var Discount
     */
    private $discount;
    /**
     * @var DiscountProperty
     */
    private $discountProperty;

    /**
     * @param Discount $discount
     * @param DiscountProperty $discountProperty
     */
    public function __construct(
        Discount $discount,
        DiscountProperty $discountProperty
    )
    {
        $this->discount         = $discount;
        $this->discountProperty = $discountProperty;
    }

    public function save($data)
    {
        if(!is_null($data['late_availability_id'])) {
            try {
                $discount = $this->discount->where('id', $data['late_availability_id'])->first();
                $discount = $this->getCommonFields($data,$discount);
                $discount->update();
                $this->discountProperty->where('discount_id', intval($data['late_availability_id']))->delete();

                if (!is_null($data['property_id'])) {
                    foreach ($data['property_id'] as $item) {
                        $discountProperty = new $this->discountProperty;
                        $discountProperty->discount_id = $data['late_availability_id'];
                        $discountProperty->property_id = $item;
                        $discountProperty->save();
                    }
                }

                return 'Data Updated successfully.';
            } catch (\Exception $e){
                return catchException($e->getMessage());
            }

        } else {
            try {
                $discount = new $this->discount;
                $discount = $this->getCommonFields($data,$discount);
                $discount->save();
                $discount_id = $discount->id;

                if (!is_null($data['property_id'])) {
                    foreach ($data['property_id'] as $item) {
                        $discountProperty = new $this->discountProperty;
                        $discountProperty->discount_id = $discount_id;
                        $discountProperty->property_id = $item;
                        $discountProperty->save();
                    }
                }

                return "Data Saved Successfully";
            } catch (\Exception $e) {
                return catchException($e->getMessage());
            }
        }
    }

    /**
     * @param $data
     * @param $discount
     * @return mixed
     */
    public function getCommonFields($data, $discount)
    {
        $discount->days        = $data['days'];
        $discount->value       = $data['value'];
        $discount->start_date  = dateFormat($data['start_date']);
        $discount->expiry_date = dateFormat($data['expiry_date']);

        return $discount;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        return $this->discount->where('id',$id)->with('properties')->get();
    }

    /**
     * @return Collection|Discount[]
     */
    public function all()
    {
        return $this->discount->all();
    }

    public function delete(int $id)
    {
        try {
            $this->discountProperty->where('discount_id', $id)->delete();
            $this->discount->where('id', $id)->delete();

            return "Data Deleted Successfully";
        } catch (\Exception $e) {
            return catchException($e->getMessage());
        }
    }
}