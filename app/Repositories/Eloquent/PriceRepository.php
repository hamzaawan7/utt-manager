<?php

namespace App\Repositories\Eloquent;

use App\Models\PriceCategoryType;
use App\Repositories\PriceRepositoryInterface;

class PriceRepository implements PriceRepositoryInterface
{

    /** @var PriceCategoryType $price */
    public function __construct(PriceCategoryType $price)
    {
        $this->price = $price;
    }

    /**
     * @param $data
     * @return string
     */
    public function save($data): string
    {
            try {
                //dd($data);
                $value = explode('_', $data['price_category_id']);
                $categoryId = $value[0];
                $array = explode(' ', $value[1]);
                $categoryName = strtolower($array[0]);

                if ($categoryName === 'standard') {
                    for ($i = 0; $i <= 5; $i++) {
                        $value   = explode('_', $data['type_'.$i]);
                        $typeId  = $value[1];
                        $price   = new $this->price;
                        $price->price_category_id = $categoryId;
                        $price->type_id = $typeId;
                        $price->year = $data['years_'.$i];
                        $price->price_seven_night = $data['priceSevenNights_' .$i];
                        $price->price_monday_to_friday = $data['mondayToFriday_' . $i];
                        $price->price_friday_to_monday = $data['fridayToMonday_' . $i];
                        $price->save();
                    }
                } else {
                    if ($categoryName === 'flexible') {
                        for ($i = 0; $i <= 5; $i++) {
                            $value  = explode('_', $data['type_'.$i]);
                            $typeId = $value[1];
                            $price  = new $this->price;
                            $price->price_category_id      = $categoryId;
                            $price->type_id                = $typeId;
                            $price->year                   = $data['yearf_' . $i];
                            $price->price_standing_charge  = $data['standingCharge_' . $i];
                            $price->price_sunday_to_thursday = $data['sundayToThursday_' . $i];
                            $price->price_friday_to_saturday = $data['fridayToSaturday_' . $i];
                            $price->price_seven_night = $data['sevenNightsPrice_' . $i];
                            $price->weekend_friday_to_monday = $data['weekendPrice_' . $i];
                            $price->save();
                        }
                    }
                }

                return "Data Saved Successfully";
            } catch (\Exception $e) {
                return $e->getMessage();
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