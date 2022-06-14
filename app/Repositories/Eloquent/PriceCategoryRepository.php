<?php

namespace App\Repositories\Eloquent;

use App\Models\PriceCategory;
use App\Repositories\PriceCategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class PriceCategoryRepository implements PriceCategoryRepositoryInterface
{
    /**
     * @var PriceCategory
     */
    private $priceCategory;

    /** @var PriceCategory $priceCategory */
    public function __construct(PriceCategory $priceCategory)
    {
        $this->priceCategory = $priceCategory;
    }

    /**
     * @param $data
     * @return string|void
     */
    public function save($data)
    {
        if (!is_null($data['category_id'])) {
            try {
                $category = $this->priceCategory->find($data['category_id']);
                $category->category_name = $data['category_name'];
                $category->update();

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
            return $this->priceCategory->find($id);
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