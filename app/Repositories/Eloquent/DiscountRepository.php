<?php

namespace App\Repositories\Eloquent;

use App\Models\Property;
use App\Repositories\DiscountRepositoryInterface;
use App\Models\Discount;
use App\Models\DiscountProperty;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class DiscountRepository
 * @package App\Repositories\Eloquent
 */
class DiscountRepository implements DiscountRepositoryInterface
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

    /**
     * @param $data
     * @return string|void
     */
    public function save($data)
    {
        if(!is_null($data['discount_id'])) {
            try {
                if (empty($data['password'])) {
                    $discount = $this->discount->where('id', $data['discount_id'])->first();
                    $discount = $this->getCommonFields($data,$discount);
                    $discount->update();

                    return 'Data Updated successfully.';
                }
            } catch (\Exception $e){
                return $e->getMessage();
            }

        } else {
            try {
                $discount = new $this->discount;
                $discount = $this->getCommonFields($data,$discount);
                $discount->save();

                $discount_id = $discount->id;
                $propertyData = Property::all();

                if (isset($data['all_property'])) {
                    foreach ($propertyData as $property) {
                        $discountProperty              = new $this->discountProperty;
                        $discountProperty->discount_id = $discount_id;
                        $discountProperty->property_id = $property->id;
                        $discountProperty->save();
                    }
                }

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
                return $e->getMessage();
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
        $isActive                           = 0;
        $discount->reference_code           = $data['code'];
        $discount->code_type                = $data['code_type'];
        $discount->value                    = $data['value'];
        $discount->expiry_date              = dateFormat($data['expiry_date']);
        $discount->holiday_must_start_after = dateFormat($data['holiday_start_after']);
        $discount->holiday_must_start_by    = dateFormat($data['holiday_must_start_by']);
        $discount->email                    = $data['email'];
        $discount->reason                   = $data['reason'];

        if (isset($data['is_active'])) {
            $isActive = 1;
        }
        $discount->is_active    = $isActive;

        return $discount;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        return $this->discount->where('id',$id)->with('properties')->first();
    }

    /**
     * @return Discount[]|Collection
     */
    public function all()
    {
        return $this->discount->all();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id)
    {
        return $this->discount->find($id)->delete();
    }
}
