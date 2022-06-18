<?php

namespace App\Repositories\Eloquent;
use App\Repositories\FeatureRepositoryInterface;
use App\Models\Feature;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
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

    /**
     * @param Feature $feature
     */
    public function __construct(Feature  $feature)
    {
        $this->feature = $feature;
    }

    /**
     * @param $data
     * @return JsonResponse
     */
    public function save($data): JsonResponse
    {
        if (!is_null($data['feature_id'])) {
            try {
                $feature                 = $this->feature::find($data['feature_id']);
                $feature->feature_name   = $data['feature_name'];
                $feature->update();

                return response()->json([
                    'status' => 200,
                    'message' => 'Data Updated Successfully'
                ]);
            } catch (\Exception $e) {
                return catchException($e->getMessage());
            }

        } else {
            try {
                $feature                 = new $this->feature;
                $feature->feature_name  = $data['feature_name'];
                $feature->save();

                return response()->json([
                    'status' => 200,
                    'message' => 'Data Saved Successfully'
                ]);
            } catch (\Exception $e) {
                return catchException($e->getMessage());
            }
        }
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
      return $this->feature->find($id);
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
