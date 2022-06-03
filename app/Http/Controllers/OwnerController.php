<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Repositories\OwnerRepositoryInterface;
use Illuminate\Routing\Controller;
use App\Http\Requests\OwnerSaveRequest;
use DataTables;

/**
 * Class OwnerController
 * @package App\Http\Controllers
 */
class OwnerController extends Controller
{
    /** @var OwnerRepositoryInterface $ownerRepository */
    private $ownerRepository;

    public function __construct(OwnerRepositoryInterface  $ownerRepository)
    {
        $this->ownerRepository = $ownerRepository;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('owner.list');
    }

    /**
     * @param Request $request
     * @return void
     */
    public function getOwner(Request $request)
    {
        if ($request->ajax()) {
            $ownerList = $this->ownerRepository->all();
            return Datatables::of($ownerList)
                ->addIndexColumn()
                ->addColumn('action', function($ownerList){
                    $actionBtn = '
                                  <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#"
                                   role="button" data-toggle="dropdown">
                                    <i class="dw dw-more"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                    <a class="dropdown-item reset_form" href="#" onclick="findOwner(\'/owner/find/'.$ownerList->id.'\')">
                                        <i class="dw dw-edit2"></i> Edit
                                    </a>
                                    <a class="dropdown-item" onclick="deleteOwner(\'/owner/delete/'.$ownerList->id.'\')">
                                        <i class="dw dw-delete-3" style="cursor: pointer;"> Delete</i>
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
     * @param OwnerSaveRequest $request
     * @return JsonResponse
     */
    public function save(OwnerSaveRequest $request): JsonResponse
    {
        $category = $this->ownerRepository->save($request->input());
        if ($category) {
            return response()->json([
                'status'=>200,
                'message'=> $category
               ]);
        }

        return response()->json("Error Your Request");
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function find(int $id): JsonResponse
    {
        $response = $this->ownerRepository->find($id);
        $response->user;

        return response()->json($response);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function delete($id): JsonResponse
    {
        $message = $this->ownerRepository->delete($id);
            return response()->json([
                'status'=>200,
                'message'=>$message
            ]);
        }
}
