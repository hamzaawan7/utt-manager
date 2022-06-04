<?php

namespace App\Repositories\Eloquent;
use App\Repositories\PriceCategoryRepositoryInterface;
use App\Models\PriceCategory;
use Illuminate\Database\Eloquent\Collection;

class PriceCategoryRepository implements PriceCategoryRepositoryInterface
{
    /**
     * @var PriceCategory
     */
    private $priceCategory;

    /** @var PriceCategory $priceCategory */
    public function __construct(PriceCategory  $priceCategory)
    {
        $this->priceCategory = $priceCategory;
    }

    /**
     * @param $data
     * @return string
     */
    public function save($data): string
    {
        try {
            $category = new $this->priceCategory;
            $category->category = $data['category_name'];
            $category->save();

            return $category;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        try {
            return $this->priceCategory::where('id', $id)->first();
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
            return $this->priceCategory->find($id)->delete();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}