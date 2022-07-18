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
                    $user = $this->user->where('id' ,intval($data['owner_id']))->first();
                    $user = $this->getCommonFields($data,$user);
                    $user->update();
                    $owner = $this->owner->where('user_id', $data['owner_id'])->first();
                    $owner->owner_name = $data['name'];
                    $owner->address    = $data['address'];
                    $owner->phone      = $data['phone'];
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
                $user  = new $this->user;
                $owner = $this->getCommonFields($data,$user);
                $user->save();
                $user->syncRoles('owner');
                $user_id = $user->id;
                $owner = new $this->owner;
                $owner->user_id  = $user_id;
                $owner->owner_name = $data['name'];
                $owner->address    = $data['address'];
                $owner->phone      = $data['phone'];
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
    public function getCommonFields($data,$user)
    {
        $user->name     = $data['name'];
        $user->email    = $data['email'];
        $user->password = Hash::make($data['password']);

        return $user;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        return $this->owner->where('id', $id)->with('user')->first();
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
            $user = $this->owner->find($id);
            $userId = $user->user_id;
            $this->owner->find($id)->delete();
            $this->user->find($userId)->delete();

            return "Data Deleted Successfully";
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }
}
