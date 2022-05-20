<?php

namespace App\Repositories\Eloquent;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\User;

/**
 * Class UserRepository
 * @package App\Repositories\Eloquent
 */
class UserRepository implements UserRepositoryInterface
{
    /** @var User $user */
    public function __construct(User  $user)
    {
        $this->user = $user;
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
                $user->last_name    = $data['last_name'];
                $user->email    = $data['email'];
                $user->city    = $data['city'];
                $user->country    = $data['country'];
                $user->update();
                $user->syncRoles($data['role']);

                return "Data Update Successfully";
            }catch (\Exception $e){
                return $e->getMessage();
            }
        }else{
            try {
                $user = new $this->user;
                $user->name     = $data['name'];
                $user->last_name    = $data['last_name'];
                $user->email    = $data['email'];
                $user->password    = $data['password'];
                $user->city    = $data['city'];
                $user->country    = $data['country'];
                $user->save();
                $user->syncRoles($data['role']);

                return "Data Inserted Successfully";
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
        return $this->user::where('id',$id)->first();
    }

    /**
     * @return void
     */
    public function all()
    {
        return $this->user::orderBy('id','DESC')->paginate(10);
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