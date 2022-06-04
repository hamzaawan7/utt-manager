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
    /**
     * @var Review
     */
    private $review;
    public function __construct(Review $review)
    {
        $this->review = $review;
    }

    /**
     * @param $data
     * @return string|void
     */
    public function save($data)
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
    public function find(int $id)
    {
        return $this->review->find($id);
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->review->all();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id)
    {
        try {
             $this->review->find($id)->delete();

             return "Data Deleted Successfully";
        } catch (\Exception $e){
            return $e->getMessage();
        }
    }
}