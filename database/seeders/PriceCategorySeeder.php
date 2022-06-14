<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PriceCategory;

class PriceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category =  [
            [
                'category_name' => 'Standard A',
            ],
            [
                'category_name' => 'Flexible A',
            ],
            [
                'category_name' => 'Standard B',
            ],
            [
                'category_name' => 'Flexible B',
            ],
            [
                'category_name' => 'Standard C',
            ],
            [
                'category_name' => 'Flexible C',
            ],
            [
                'category_name' => 'Standard D',
            ],
            [
                'category_name' => 'Flexible D',
            ],
            [
                'category_name' => 'Standard E',
            ],
            [
                'category_name' => 'Flexible E',
            ],
            [
                'category_name' => 'Standard F',
            ],
            [
                'category_name' => 'Flexible F',
            ],
            [
                'category_name' => 'Standard G',
            ],
            [
                'category_name' => 'Flexible G',
            ],
            [
                'category_name' => 'Standard H',
            ],
            [
                'category_name' => 'Flexible H',
            ],
            [
                'category_name' => 'Standard I',
            ],
            [
                'category_name' => 'Flexible I',
            ],
            [
                'category_name' => 'Standard J',
            ],
            [
                'category_name' => 'Flexible J',
            ],
            [
                'category_name' => 'Standard K',
            ],
            [
                'category_name' => 'Flexible K',
            ],
            [
                'category_name' => 'Standard L',
            ],
            [
                'category_name' => 'Flexible L',
            ],
            [
                'category_name' => 'Standard M',
            ],
            [
                'category_name' => 'Flexible M',
            ],
            [
                'category_name' => 'Standard N',
            ],
            [
                'category_name' => 'Flexible N',
            ],
            [
                'category_name' => 'Standard O',
            ],
            [
                'category_name' => 'Flexible O',
            ],
            [
                'category_name' => 'Standard P',
            ],
            [
                'category_name' => 'Flexible P',
            ],
            [
                'category_name' => 'Standard Q',
            ],
            [
                'category_name' => 'Flexible Q',
            ],
            [
                'category_name' => 'Standard R',
            ],
            [
                'category_name' => 'Flexible R',
            ],
            [
                'category_name' => 'Standard S',
            ],
            [
                'category_name' => 'Flexible S',
            ],
            [
                'category_name' => 'Standard T',
            ],
            [
                'category_name' => 'Flexible T',
            ],
            [
                'category_name' => 'Standard U',
            ],
            [
                'category_name' => 'Flexible U',
            ],
            [
                'category_name' => 'Standard V',
            ],
            [
                'category_name' => 'Flexible V',
            ],
            [
                'category_name' => 'Standard W',
            ],
            [
                'category_name' => 'Flexible W',
            ],
            [
                'category_name' => 'Standard X',
            ],
            [
                'category_name' => 'Flexible X',
            ],
            [
                'category_name' => 'Standard Y',
            ],
            [
                'category_name' => 'Flexible Y',
            ],
            [
                'category_name' => 'Standard Z',
            ],
            [
                'category_name' => 'Flexible Z',
            ],
        ];

        PriceCategory::insert($category);
    }
}
