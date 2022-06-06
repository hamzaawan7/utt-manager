<?php

namespace App\Repositories\Eloquent;

use App\Repositories\PropertyCategoryRepositoryInterface;
use App\Models\Category;

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

    /** @var Category $propertyCategory */
    public function __construct(Category  $propertyCategory)
    {
        $this->propertyCategory = $propertyCategory;
    }

    /**
     * @param $data
     * @return string
     */
    public function save($data): string
    {
        if(!is_null($data['category_id'])) {
            try {
                $category = $this->propertyCategory::find($data['category_id']);
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
        $category->category_name = $data['category_name'];
        $category->standard_guests = $data['standard_guests'];
        $category->minimum_guest = $data['minimum_guest'];
        $category->room_layouts = $data['room_layouts'];
        $category->childs = $data['childs'];
        $category->infants = $data['infants'];
        $category->pets = $data['pets'];

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
            if (!$this->propertyCategory->where('id', $id)->get()) {
                $this->propertyCategory->find($id)->delete();
                $message = "Data Deleted Successfully";
                $status  = 200;
            } else {
                 $message = "Category Used not Deleted";
                $status   = 400;
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
