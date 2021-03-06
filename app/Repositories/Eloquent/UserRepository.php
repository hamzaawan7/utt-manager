<?php

namespace App\Repositories\Eloquent;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Owner;
use App\Models\Customer;
use App\Models\Enums\UserRoles;

/**
 * Class UserRepository
 * @package App\Repositories\Eloquent
 */
class UserRepository implements UserRepositoryInterface
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var Owner
     */
    private $owner;

    /**
     * @var Customer
     */
    private $customer;

    /**
     * @param User $user
     * @param Owner $owner
     * @param Customer $customer
     */
    public function __construct(
        User      $user,
        Owner    $owner,
        Customer $customer
    )
    {
        $this->user = $user;
        $this->owner = $owner;
        $this->customer = $customer;
    }
    /**
     * @param $data
     * @return string
     */
    public function save($data): string
    {
        if(!is_null($data['user_id'])) {
            try {
                $user = $this->user->find($data['user_id']);
                $user->name     = $data['name'];
                $user->email    = $data['email'];
                $user->update();
                $user->syncRoles($data['role']);

                return "Data Updated Successfully";
            } catch (\Exception $e){
                return $e->getMessage();
            }
        } else {
            try {
                $user                = new $this->user;
                $user->name          = $data['name'];
                $user->email         = $data['email'];
                $user->password      = Hash::make($data['password']);
                $user->save();
                $user->syncRoles($data['role']);

                return "Data Inserted Successfully";
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
        return $this->user->find($id);
    }

    /**
     * @return void
     */
    public function all()
    {
        return $this->user->orderBy('id','DESC')->paginate(10);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id)
    {
        $roleName = User::find($id)->getRoleNames();
        if ($roleName[0] == UserRoles::OWNER) {
            $this->owner->where('user_id',$id)->delete();
            return $this->user->find($id)->delete();
        }
        if ($roleName[0] == UserRoles::CUSTOMER) {
            $this->user->where('user_id',$id)->delete();
            return $this->user->find($id)->delete();
        }

        return $this->user->find($id)->delete();
    }
}
