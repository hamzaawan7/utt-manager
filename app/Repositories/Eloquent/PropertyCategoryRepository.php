<?php

namespace App\Repositories\Eloquent;

use App\Repositories\PropertyCategoryRepositoryInterface;
use App\Models\Category;
use App\Models\CategoryProperty;

/**
 * Class PropertyCategoryRepository
 * @package App\Repositories\Eloquent
 */
class PropertyCategoryRepository implements PropertyCategoryRepositoryInterface
{
    /**
     * @var Category
     */
    private $propertyCategory;

    /**
     * @param CategoryProperty $categoryProperty
     * @var Category $propertyCategory
     */
    public function __construct(
        Category  $propertyCategory,
        CategoryProperty $categoryProperty
    )
    {
        $this->propertyCategory = $propertyCategory;
        $this->categoryProperty = $categoryProperty;
    }

    /**
     * @param $data
     * @return string
     */
    public function save($data): string
    {
        if(!is_null($data['category_id'])) {
            try {
                $category = $this->propertyCategory->find($data['category_id']);
                $category = $this->getCommonFields($category,$data);
                $category->update();

                return "Data Updated Successfully";
            } catch (\Exception $e) {
                return $e->getMessage();
            }

        } else {
            try {
                $category = new $this->propertyCategory;
                $category = $this->getCommonFields($category,$data);
                $category->save();

                return "Data Saved Successfully";
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }
    }

    /**
     * @param $category
     * @param $data
     * @return mixed
     */
    public function getCommonFields($category,$data)
    {
        $includeInSearchFilter = 0;
        $includeInHeader        = 0;
        if (isset($data['include_in_search_filter'])) {
            $includeInSearchFilter = 1;
        }
        if (isset($data['include_in_header'])) {
            $includeInHeader = 1;
        }
        $category->category_name = $data['category_name'];
        $category->include_in_search_filter = $includeInSearchFilter;
        $category->include_in_header = $includeInHeader;

        return $category;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        return $this->propertyCategory->find($id);
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->propertyCategory->all();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id)
    {
        try {
            $category = $this->categoryProperty->where('category_id',$id)->count();
            if ($category > 0) {
                $message = "Category Used not Deleted";
                $status  = 400;
            } else {
                $this->propertyCategory->find($id)->delete();
                $message = "Data Deleted Successfully";
                $status  = 200;
            }

            return response()->json([
                'status' => $status,
                'message' => $message,
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
