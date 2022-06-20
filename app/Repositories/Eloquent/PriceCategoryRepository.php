<?php

namespace App\Repositories\Eloquent;

use App\Models\PriceCategory;
use App\Models\PriceCategoryType;
use App\Repositories\PriceCategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class PriceCategoryRepository
 * @package App\Repositories\Eloquent
 */
class PriceCategoryRepository implements PriceCategoryRepositoryInterface
{
    /**
     * @var PriceCategory
     */
    private $priceCategory;
    /**
     * @var PriceCategoryType
     */
    private $priceCategoryType;

    /**
     * @param PriceCategoryType $priceCategoryType
     * @param PriceCategory $priceCategory
     */
    public function __construct(
        PriceCategoryType $priceCategoryType,
        PriceCategory     $priceCategory
    )
    {
        $this->priceCategory = $priceCategory;
        $this->priceCategoryType = $priceCategoryType;
    }

    /**
     * @param $data
     * @return string|void
     */
    public function save($data)
    {
        if (!is_null(intval($data['price_category_id']))) {
            try {
                //dd($data);
                $value = explode('_', $data['category_price_id']);
                $categoryId = $value[0];
                $array = explode(' ', $value[1]);
                $categoryName = strtolower($array[0]);

                if ($categoryName === 'standard') {
                    for ($i = 0; $i <= 5; $i++) {
                        $this->priceCategoryType->where('id', $data['price_category_id'][$i])
                            ->update([
                                'price_seven_night' => $data['priceSevenNights_' . $i],
                                'price_monday_to_friday' => $data['mondayToFriday_' . $i],
                                'price_friday_to_monday' => $data['fridayToMonday_' . $i]
                            ]);
                    }
                } else {
                    if ($categoryName === 'flexible') {
                        for ($i = 0; $i <= 5; $i++) {
                            $this->priceCategoryType->where('id', $data['price_category_id'][$i])->update([
                                'price_standing_charge' => $data['standingCharge_' . $i],
                                'price_sunday_to_thursday' => $data['sundayToThursday_' . $i],
                                'price_friday_to_saturday' => $data['fridayToSaturday_' . $i],
                                'price_seven_night' => $data['sevenNightsPrice_' . $i],
                                'weekend_friday_to_monday' => $data['weekendPrice_' . $i]
                            ]);
                        }
                    }
                }

                return "Data Updated Successfully";
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        try {
            return $this->priceCategoryType
                ->join('price_categories', 'price_categories.id', '=', 'price_category_type.price_category_id')
                ->join('types', 'types.id', '=', 'price_category_type.type_id')
                ->select('price_category_type.*', 'types.type', 'price_categories.category_name')
                ->where('price_category_type.price_category_id', $id)
                ->get();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @return Collection|PriceCategory[]
     */
    public function all()
    {
        return $this->priceCategory->all();
    }

    /**
     * @param int $id
     * @return string
     */
    public function delete(int $id): string
    {
        try {
            $this->priceCategory->find($id)->delete();

            return "Data Deleted Successfully";
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}