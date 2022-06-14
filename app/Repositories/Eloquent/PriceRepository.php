<?php

namespace App\Repositories\Eloquent;

use App\Models\TypePriceCategory;
use App\Repositories\PriceRepositoryInterface;

class PriceRepository implements PriceRepositoryInterface
{

    /** @var TypePriceCategory $price */
    public function __construct(TypePriceCategory $price)
    {
        $this->price = $price;
    }

    /**
     * @param $data
     * @return string
     */
    public function save($data): string
    {
        if (!is_null($data['price_id'])) {
            try {
                $price = $this->propertyCategory->find($data['price_id']);
                $price = $this->getCommonFields($price, $data);
                $price->update();

                return "Data Updated Successfully";
            } catch (\Exception $e) {
                return $e->getMessage();
            }

        } else {
            try {
                $price = new $this->price;
                $price = $this->getCommonFields($price, $data);
                $price->save();

                return "Data Saved Successfully";
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }
    }

    /**
     * @param $price
     * @param $data
     * @return mixed
     */
    public function getCommonFields($price, $data)
    {
        $price->price_category_id = $data['price_category_id'];
        $price->type_id = $data['type_id'];
        $price->price_seven_night = $data['price_seven_night'];
        $price->price_monday_to_friday = $data['price_monday_to_friday'];
        $price->price_friday_to_monday = $data['price_friday_to_monday'];

        return $price;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        $ass = $this->price->find($id);
        dd($ass->with('categories')->get());
    }

    /**$ass
     * @return mixed
     */
    public function all()
    {
        return $this->price->all();
    }

    /**
     * @param int $id
     * @return string
     */
    public function delete(int $id): string
    {
        try {
            $this->price->find($id)->delete();

            return "Data Deleted Successfully";
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}