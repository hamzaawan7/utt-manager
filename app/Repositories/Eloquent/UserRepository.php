<?php

namespace App\Repositories\Eloquent;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Owner;
use App\Models\Customer;

/**
 * Class UserRepository
 * @package App\Repositories\Eloquent
 */
class UserRepository implements UserRepositoryInterface
{
    /**
     * @param Owner $owner
     * @param Customer $customer
     * @var User $user
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
                $user = $this->user::find($data['user_id']);
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
        return $this->user->where('id',$id)->first();
    }

    /**
     * @return void
     */
    public function all()
    {
        return $this->user->orderBy('id','DESC')->paginate(10);
    }

    /**
     * @return void
     */
    public function get()
    {

    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id)
    {
        return $this->user::where('id',$id)->delete();
    }

}