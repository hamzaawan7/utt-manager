<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Class SuperAdminSeeder
 * @package Database\Seeder
 */
class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user =  [
            [
                'name' => 'Super Admin',
                'email' => 'hello@pobl.tech',
                'password' => Hash::make('secret'),
            ],
        ];

        User::insert($user);
    }
}
