<?php

namespace App\Repositories\Eloquent;
use App\Repositories\ReviewRepositoryInterface;
use App\Models\Review;
use Illuminate\Database\Eloquent\Collection;

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

    /**
     * @param Review $review
     */
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
                $review = $this->review->find($data['review_id']);
                $review->comment = $data['comment'];
                if (isset($data['is_accept'])){
                    $accept = 1;
                }
                $review->approve = $accept;
                $review->update();

                return 'Data Updated successfully.';
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
     * @return Collection|Review[]
     */
    public function all()
    {
        return $this->review->all();
    }

    /**
     * @param int $id
     * @return string
     */
    public function delete(int $id): string
    {
        try {
             $this->review->find($id)->delete();

             return "Data Deleted Successfully";
        } catch (\Exception $e){
            return $e->getMessage();
        }
    }
}