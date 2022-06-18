<?php

namespace App\Repositories\Eloquent;
use App\Repositories\OwnerRepositoryInterface;
use App\Models\Owner;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

/**
 * Class OwnerRepository
 * @package App\Repositories\Eloquent
 */
class OwnerRepository implements OwnerRepositoryInterface
{
    /**
     * @var Owner
     */
    private $owner;
    /**
     * @var User
     */
    private $user;

    /**
     * @param Owner $owner
     * @param User $user
     */
    public function __construct(
        Owner  $owner,
        User   $user
    )
    {
        $this->owner = $owner;
        $this->user = $user;
    }

    /**
     * @param $data
     * @return JsonResponse|void
     */
    public function save($data)
    {
        if(!is_null($data['owner_id'])) {
            try {
                if (empty($data['password'])) {
                    $owner = $this->owner->find($data['owner_id']);
                    $owner = $this->getCommonFields($data,$owner);
                    $owner->update();

                    return response()->json([
                        'status' => 200,
                        'message' => 'Data Updated Successfully'
                    ]);
                }
            } catch (\Exception $e){
                return catchException($e->getMessage());
            }

        } else {
            try {
                $owner = new $this->owner;
                $owner = $this->getCommonFields($data,$owner);
                $owner->save();

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
     * @param $data
     * @param $owner
     * @return mixed
     */
    public function getCommonFields($data,$owner)
    {
        $owner->name     = $data['name'];
        $owner->email    = $data['email'];
        $owner->password = Hash::make($data['password']);
        $owner->address  = $data['address'];
        $owner->phone    = $data['phone'];

        return $owner;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        return $this->owner->where('id', $id)->with('user')->get();
    }

    /**
     * @return Collection|Owner[]
     */
    public function all()
    {
        return $this->owner->all();
    }

    /**
     * @param int $id
     * @return string
     */
    public function delete(int $id): string
    {
        try {
            $this->owner->find($id)->delete();

            return "Data Deleted Successfully";
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }
}
