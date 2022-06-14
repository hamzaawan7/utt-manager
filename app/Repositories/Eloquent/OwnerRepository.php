<?php

namespace App\Repositories\Eloquent;
use App\Repositories\OwnerRepositoryInterface;
use App\Models\Owner;
use App\Models\User;
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
     * @var User $user
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
     * @return string|void
     */
    public function save($data)
    {
        if(!is_null($data['owner_id'])) {
            try {
                if (empty($data['password'])) {
                    $user = $this->user->where('id', $data['owner_id'])->first();
                    $user->name = $data['name'];
                    $user->email = $data['email'];
                    $user->update();
                    $owner = $this->owner->where('user_id', $data['owner_id'])->first();
                    $this->getCommonFields($data,$owner);
                    $owner->update();

                    return 'Data Updated successfully.';
                }
            } catch (\Exception $e){
                return $e->getMessage();
            }

        } else {
            try {
                $user           = new $this->user;
                $user->name     = $data['name'];
                $user->email    = $data['email'];
                $user->password = Hash::make($data['password']);
                $user->save();
                $user->syncRoles('owner');
                $user_id                         = $user->id;
                $owner                           = new $this->owner;
                $this->getCommonFields($data,$owner);
                $owner->user_id                  = $user_id;
                $owner->save();

                return "Data Saved Successfully";
            } catch (\Exception $e) {
                return $e->getMessage();
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
        $owner->owner_name               = $data['name'];
        $owner->address                  = $data['address'];
        $owner->main_contact_name        = $data['main_contact_name'];
        $owner->main_contact_number      = $data['main_contact_number'];
        $owner->secondary_contact_name   = $data['secondary_contact_name'];
        $owner->secondary_contact_number = $data['secondary_contact_number'];
        $owner->emergency_contact_name   = $data['emergency_contact_name'];
        $owner->emergency_contact_number = $data['emergency_contact_number'];
        $owner->cleaning_rota_receipts = $data['cleaning_rota_receipts'];
        $owner->bank_account_number = $data['bank_account_number'];
        $owner->bank_account_short_code = $data['bank_account_short_code'];

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
     * @return mixed
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
            $owner = $this->owner->find($id);
            $user_id  = $owner->user_id;
            $this->owner->find($id)->delete();
            $this->user->where('id',$user_id)->delete();

            return "Data Deleted Successfully";
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }
}
