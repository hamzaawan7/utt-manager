<?php

namespace Database\Seeders;

use App\Models\Role;
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
                'name' => 'admin',
                'guard_name' => 'web',
            ],
            [
                'name' => 'user',
                'guard_name' => 'web',
            ],
            [
                'name' => 'owner',
                'guard_name' => 'web',
            ],
            [
                'name' => 'owner',
                'guard_name' => 'super-admin',
            ]
        ];

        Role::insert($role);
    }
}
