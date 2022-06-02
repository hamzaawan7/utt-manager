<?php

namespace App\Repositories\Eloquent;
use App\Repositories\CustomerRepositoryInterface;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

/**
 * Class CustomerRepository
 * @package App\Repositories\Eloquent
 */
class CustomerRepository implements CustomerRepositoryInterface
{

    /** @var Customer $customer */
    /**
     * @var Customer
     */
    private $customer;
    /**
     * @var User
     */
    private $user;

    /**
     * @param Customer $customer
     * @var User $user
     */
    public function __construct (
        Customer $customer,
        User $user
    )
    {
        $this->customer = $customer;
        $this->user     = $user;
    }

    /**
     * @param $data
     * @return string|void
     */
    public function save($data)
    {
        if(!is_null($data['customer_id'])) {
            try {
                if (empty($data['password'])) {
                    $user = $this->user->where('id', $data['customer_id'])->first();
                    $user->name = $data['name'];
                    $user->email = $data['email'];
                    $user->update();
                    $customer = $this->customer->where('user_id', $data['customer_id'])->first();
                    $customer->customer_name = $data['name'];
                    $customer->phone = $data['phone'];
                    $customer->address = $data['address'];
                    $customer->post_code = $data['post_code'];
                    $customer->city = $data['city'];
                    $customer->country = $data['country'];
                    $customer->update();

                    return 'Data updated successfully.';
                }
            } catch (\Exception $e) {
                return $e->getMessage();
            }

        } else {
            try{
                $user           = new $this->user;
                $user->name     = $data['name'];
                $user->email    = $data['email'];
                $user->password = Hash::make($data['password']);
                $user->save();
                $user->syncRoles('customer');
                $user_id = $user->id;
                $customer = new $this->customer;
                $customer->user_id = $user_id;
                $customer->customer_name = $data['name'];
                $customer->phone = $data['phone'];
                $customer->address = $data['address'];
                $customer->post_code = $data['post_code'];
                $customer->city = $data['city'];
                $customer->country = $data['country'];
                $customer->save();

                return "Data Saved Successfully";
            } catch (\Exception $e) {
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
        return $this->customer->find($id);
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->customer::all();
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
            $customer = $this->customer->where('id',$id)->first();
            $user_id  = $customer->user_id;
            $this->customer->find($id)->delete();
            $this->user->where('id',$user_id)->delete();

            return "Data Deleted Successfully";
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }
}