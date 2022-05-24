<?php

namespace App\Repositories\Eloquent;
use App\Repositories\FeatureRepositoryInterface;
use App\Models\Feature;
use Illuminate\Support\Carbon;

/**
 * Class FeatureRepository
 * @package App\Repositories\Eloquent
 */
class FeatureRepository implements FeatureRepositoryInterface
{
    /** @var Feature $feature */
    public function __construct(Feature  $feature)
    {
        $this->feature = $feature;
    }

    /**
     * @param $data
     * @return string
     */
    public function save($data): string
    {
        if(!is_null($data['feature_id'])) {
            try {
                $category                 = $this->feature::find($data['feature_id']);
                $category->feature_name   = $data['feature_name'];
                $checkIn                  = Carbon::parse($data['check_in_time']);
                $checkOut                 = Carbon::parse($data['check_out_time']);
                $category->check_in_time  = $checkIn->format('Y-m-d H:i:s');
                $category->check_out_time = $checkOut->format('Y-m-d H:i:s');
                $category->minimum_nights = $data['minimum_nights'];
                $category->update();

                return 'Data update successfully.';
            } catch (\Exception $e){
                return $e->getMessage();
            }

        }else{
            try{
                $category                 = new $this->feature;
                $category->feature_name   = $data['feature_name'];
                $checkIn                  =  Carbon::parse($data['check_in_time']);
                $checkOut                 = Carbon::parse($data['check_out_time']);
                $category->check_in_time  = $checkIn->format('Y-m-d H:i:s');
                $category->check_out_time = $checkOut->format('Y-m-d H:i:s');
                $category->minimum_nights = $data['minimum_nights'];
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
        return $this->feature::where('id', $id)->first();
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->feature::all();
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
            $this->feature::where('id',$id)->delete();

            return "Data Deleted Successfully";
        }catch (\Exception $e){
            return $e->getMessage();
        }

    }

}