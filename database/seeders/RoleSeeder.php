<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Enums\UserRoles;
use Illuminate\Database\Seeder;

/**
 * Class RoleSeeder
 * @package Database\Seeder
 */
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role =  [
            [
                'name' => UserRoles::SUPER_ADMIN,
                'guard_name' => 'web',
            ],
            [
                'name' => UserRoles::ADMIN,
                'guard_name' => 'web',
            ],
            [
                'name' => UserRoles::OWNER,
                'guard_name' => 'web',
            ],
            [
                'name' => UserRoles::CUSTOMER,
                'guard_name' => 'web',
            ],
            [
                'name' => UserRoles::USER,
                'guard_name' => 'web',
            ],
        ];

        Role::insert($role);
    }
}
