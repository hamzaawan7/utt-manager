<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $review =  [
            [
                'comment' => 'Better',
                'approve' => 1,
            ],
            [
                'comment' => 'Like',
                'approve' => 0,
            ],
            [
                'comment' => 'Best',
                'approve' => 1,
            ],
            [
                'comment' => 'Best Offer',
                'approve' => 1,
            ]
        ];

        Review::insert($review);

    }
}
