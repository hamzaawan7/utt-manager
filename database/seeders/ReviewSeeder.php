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
                'review_id' => 1,
                'comment' => 'better',
                'star_rating' => 3,
                'is_accept' => 1,
                'is_show' => 1,
            ],
            [
                'review_id' => 2,
                'comment' => 'like',
                'star_rating' => 4,
                'is_accept' => 1,
                'is_show' => 1,
            ],
            [
                'review_id' => 3,
                'comment' => 'best offer',
                'star_rating' => 4,
                'is_accept' => 0,
                'is_show' => 0,
            ],
            [
                'review_id' => 4,
                'comment' => 'hello',
                'star_rating' => 4,
                'is_accept' => 1,
                'is_show' => 0,
            ]
        ];

        Review::insert($review);

    }
}
