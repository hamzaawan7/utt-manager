<?php

namespace App\Repositories\Eloquent;
use App\Models\Type;
use App\Repositories\TypeRepositoryInterface;

class TypeRepository implements TypeRepositoryInterface
{
    /** @var Type $type */
    public function __construct(Type $type)
    {
        $this->type = $type;
    }

    /**
     * @param $data
     * @return string
     */
    public function save($data): string
    {
        if (!is_null($data['type_id'])) {
            try {
                $type = $this->type->find($data['price_id']);
                $type = $this->getCommonFields($type, $data);
                $type->update();

                return "Data Updated Successfully";
            } catch (\Exception $e) {
                return $e->getMessage();
            }

        } else {
            try {
                $type  = new $this->type;
                $value =  explode('_', $data['price_category_id']);
                $categoryId   = $value[0];
                $array = explode(' ', $value[1]);
                $categoryName = strtolower($array[0]);

                for ($i =0; $i<5; $i++) {
                    if ($categoryName === 'standard') {
                        $type->type = $data['type_'.$i];
                        $type->price_seven_night = $data['priceSevenNights_'.$i];
                        $type->price_monday_to_friday = $data['mondayToFriday_'.$i];
                        $type->price_friday_to_monday = $data['fridayToMonday_'.$i];
                        $type->year = $data['year_'.$i];
                        $type->save();
                    }
                }

                return "Data Saved Successfully";
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
        return $this->type->find($id);
    }

    /**$ass
     * @return mixed
     */
    public function all()
    {
        return $this->type->all();
    }

    /**
     * @param int $id
     * @return string
     */
    public function delete(int $id): string
    {
        try {
            $this->type->find($id)->delete();

            return "Data Deleted Successfully";
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}