<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Repositories\ReviewRepositoryInterface;
use App\Models\Review;
use DataTables;

/**
 * Class ReviewController
 * @package App\Http\Controllers
 */
class ReviewController extends Controller
{
    /** @var Review $review */
    /** @var ReviewRepositoryInterface $reviewRepository */
    private $reviewRepository;
    public function __construct(
        ReviewRepositoryInterface  $reviewRepository,
        Review $review
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
     */
    public function getReview(Request $request)
    {
        if ($request->ajax()) {
            $reviewList = $this->reviewRepository->all();
            return Datatables::of($reviewList)
                ->addIndexColumn()
                ->addColumn('action', function($reviewList){
                    $actionBtn = '
                                  <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#"
                                   role="button" data-toggle="dropdown">
                                    <i class="dw dw-more"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                    <a class="dropdown-item reset_form" href="#" onclick="editReview(\'/review/edit/'.$reviewList->id.'\')">
                                        <i class="dw dw-edit2"></i> Edit
                                    </a>
                                    <a class="dropdown-item btn-delete" onclick="deleteReview(\'/review/delete/'.$reviewList->id.'\')">
                                        <i class="dw dw-delete-3"> Delete</i>
                                    </a>
                                </div>
                            </div>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse|void
     */
    public function save(Request $request)
    {
        $category = $this->reviewRepository->save($request->input());
        if ($category) {
            return response()->json($category);
        }
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function edit(int $id): JsonResponse
    {
        $response = $this->reviewRepository->edit($id);

        return response()->json($response);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        $response = $this->reviewRepository->delete($id);

        return response()->json($response);
    }
}
