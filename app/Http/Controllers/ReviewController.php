<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Repositories\ReviewRepositoryInterface;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Yajra\DataTables\DataTables;

/**
 * Class ReviewController
 * @package App\Http\Controllers
 */
class ReviewController extends Controller
{
    /** @var Review $review */
    /** @var ReviewRepositoryInterface $reviewRepository */
    private $reviewRepository;
    /**
     * @var Review
     */
    private $review;

    public function __construct(
        ReviewRepositoryInterface $reviewRepository,
        Review                    $review
    )
    {
        $this->reviewRepository = $reviewRepository;
        $this->review = $review;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('review.review_list');
    }

    /**
     * @param Request $request
     * @return void
     * @throws Exception
     */
    public function getReview(Request $request)
    {
        if ($request->ajax()) {
            $reviewList = $this->reviewRepository->all();
            return Datatables::of($reviewList)
                ->addIndexColumn()
                ->addColumn('action', function ($reviewList) {
                    return '
                             <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#"
                                   role="button" data-toggle="dropdown">
                                    <i class="dw dw-more"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                    <a class="dropdown-item reset_form" href="#" onclick="findReview(\'/review/find/' . $reviewList->id . '\')">
                                        <i class="dw dw-edit2"></i> Edit
                                    </a>
                                    <a class="dropdown-item btn-delete" onclick="deleteReview(\'/review/delete/' . $reviewList->id . '\')">
                                        <i class="dw dw-delete-3"> Delete</i>
                                    </a>
                                </div>
                            </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function save(Request $request): JsonResponse
    {
        return response()->json($this->reviewRepository->save($request->input()));
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function find(int $id): JsonResponse
    {
        return response()->json($this->reviewRepository->find($id));
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        return response()->json($this->reviewRepository->delete($id));
    }
}
