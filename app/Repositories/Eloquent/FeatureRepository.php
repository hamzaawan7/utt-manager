<?php

namespace App\Repositories\Eloquent;
use App\Repositories\FeatureRepositoryInterface;
use App\Models\Feature;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * Class FeatureRepository
 * @package App\Repositories\Eloquent
 */
class FeatureRepository implements FeatureRepositoryInterface
{
    /**
     * @var Feature
     */
    private $feature;
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
        if (!is_null($data['feature_id'])) {
            try {
                $feature                 = $this->feature::find($data['feature_id']);
                $feature->feature_name   = $data['feature_name'];
                $checkIn                  = Carbon::parse($data['check_in_time']);
                $checkOut                 = Carbon::parse($data['check_out_time']);
                $feature->check_in_time  = $checkIn->format('Y-m-d H:i:s');
                $feature->check_out_time = $checkOut->format('Y-m-d H:i:s');
                $feature->minimum_nights = $data['minimum_nights'];
                $feature->update();

                return 'Data update successfully.';
            } catch (\Exception $e) {
                return $e->getMessage();
            }

        } else {
            try {
                $feature                 = new $this->feature;
                $feature->feature_name   = $data['feature_name'];
                $checkIn                  = date('Y-m-d H:i:s',strtotime($data['check_in_time']));
                $checkOut                 = date('Y-m-d H:i:s',strtotime($data['check_out_time']));
                $feature->check_in_time  = $checkIn;
                $feature->check_out_time = $checkOut;
                $feature->minimum_nights = $data['minimum_nights'];
                $feature->save();

                return "Data Save Successfully";
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
      return $this->feature::select("*",DB::raw("DATE_FORMAT(check_in_time, '%d-%b-%Y') as checkInTime"),DB::raw("DATE_FORMAT(check_out_time, '%d-%b-%Y') as checkOutTime"))->where('id', $id)->first();
    }

    /**
     * @return Feature[]|Collection
     */
    public function all()
    {
        return $this->feature->all();
    }

    /**
     * @param int $id
     * @return string
     */
    public function delete(int $id): string
    {
        try {
            $this->feature->find($id)->delete();

            return "Data Deleted Successfully";
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
