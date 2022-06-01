<?php

namespace App\Repositories\Eloquent;
use App\Repositories\ReviewRepositoryInterface;
use App\Models\Review;

/**
 * Class ReviewRepository
 * @package App\Repositories\Eloquent
 */
class ReviewRepository implements ReviewRepositoryInterface
{
    /** @var Review $review */
    public function __construct(Review $review)
    {
        $this->review = $review;
    }

    /**
     * @param $data
     * @return string
     */
    public function save($data): string
    {
        if(!is_null($data['review_id'])) {
            try {
                $accept = 0;
                $show = 0;
                $review = $this->review::find($data['review_id']);
                $review->comment = $data['comment'];
                $review->star_rating = $data['star_rating'];
                if (isset($data['is_accept'])){
                    $accept = 1;
                }
                if (isset($data['is_show'])){
                    $show = 1;
                }
                $review->is_accept = $accept;
                $review->is_show = $show;
                $review->update();

                return 'Data update successfully.';
            } catch (\Exception $e){
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
        return $this->review->find($id);
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->review::all();
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
            return $this->review->find()->delete();
        }catch (\Exception $e){
            return $e->getMessage();
        }

    }

}