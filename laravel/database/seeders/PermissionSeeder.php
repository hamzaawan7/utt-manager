<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

/**
 * Class PermissionSeeder
 * @package Database\Seeder
 */
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $permission =  [
            [
                'name' => 'edit email',
                'guard_name' => 'web',
            ],
            [
                'name' => 'edit notification',
                'guard_name' => 'web',
            ],
            [
                'name' => 'edit booking',
                'guard_name' => 'web',
            ],
            [
                'name' => 'edit properties',
                'guard_name' => 'web',
            ]
        ];

        Permission::insert($permission);

    }
}
