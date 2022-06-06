<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Type;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type =  [
            [
                'type' => 'Maximum',
            ],
            [
                'type' => 'Minimum',
            ],
            [
                'type' => 'Peak',
            ],
            [
                'type' => 'High',
            ],
            [
                'type' => 'Medium',
            ],
            [
                'type' => 'Low',
            ],
        ];

        Type::insert($type);
    }
}
