<?php

namespace App\Repositories\Eloquent;

use App\Repositories\PropertyCategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

/**
 * Class PropertyCategoryRepository
 * @package App\Repositories\Eloquent
 */
class PropertyCategoryRepository implements PropertyCategoryRepositoryInterface
{
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
        if(!is_null($data['cat_id'])) {
            try {
                $category = $this->propertyCategory::find($data['cat_id']);
                $category->name = $data['name'];
                $category->standard_guests = $data['standard_guests'];
                $category->minimum_guest = $data['minimum_guest'];
                $category->room_layouts = $data['room_layouts'];
                $category->childs = $data['childs'];
                $category->infants = $data['infants'];
                $category->pets = $data['pets'];
                $category->update();

                return 'Data update successfully.';
            } catch (\Exception $e){
                return $e->getMessage();
            }

        }else{
            try{
                $category = new $this->propertyCategory;
                $category->name = $data['name'];
                $category->standard_guests = $data['standard_guests'];
                $category->minimum_guest = $data['minimum_guest'];
                $category->room_layouts = $data['room_layouts'];
                $category->childs = $data['childs'];
                $category->infants = $data['infants'];
                $category->pets = $data['pets'];
                $category->save();
                return "Data Save Successfully";
            }catch (\Exception $e){
                return $e->getMessage();
            }
        }
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function edit(int $id)
    {
        return $this->propertyCategory::where('id', $id)->first();
    }

    /**
     * @param $data
     * @return string
     */
    public function update($data): string
    {
        try{
            $category = $this->propertyCategory::where('id', intval($data['category_id']))->first();
            $category->category_name = $data['category_name'];
            $category->update();

            return $category;
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->propertyCategory::all();
    }

    /**
     * @return void
     */
    public function get()
    {
        // TODO: Implement get() method.
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id)
    {
        try {
            return $this->propertyCategory::where('id',$id)->delete();
        }catch (\Exception $e){
            return $e->getMessage();
        }

    }

}