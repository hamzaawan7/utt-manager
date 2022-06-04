<?php

namespace App\Http\Controllers;

use App\Http\Requests\OwnerSaveRequest;
use App\Repositories\OwnerRepositoryInterface;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Yajra\DataTables\DataTables;

/**
 * Class OwnerController
 * @package App\Http\Controllers
 */
class OwnerController extends Controller
{
    /** @var OwnerRepositoryInterface $ownerRepository */
    private $ownerRepository;

    public function __construct(OwnerRepositoryInterface $ownerRepository)
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
     * @throws Exception
     */
    public function getOwner(Request $request)
    {
        if ($request->ajax()) {
            $ownerList = $this->ownerRepository->all();
            return Datatables::of($ownerList)
                ->addIndexColumn()
                ->addColumn('action', function ($ownerList) {
                    return '
                             <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#"
                                   role="button" data-toggle="dropdown">
                                    <i class="dw dw-more"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                    <a class="dropdown-item reset_form" href="#" onclick="findOwner(\'/owner/find/' . $ownerList->id . '\')">
                                        <i class="dw dw-edit2"></i> Edit
                                    </a>
                                    <a class="dropdown-item" onclick="deleteOwner(\'/owner/delete/' . $ownerList->id . '\')">
                                        <i class="dw dw-delete-3" style="cursor: pointer;"> Delete</i>
                                    </a>
                                </div>
                            </div>';
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
        $message = $this->ownerRepository->save($request->input());

            return response()->json([
                'status' => 200,
                'message' => $message
            ]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function find(int $id): JsonResponse
    {
        return response()->json($this->ownerRepository->find($id));
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function delete($id): JsonResponse
    {
        $message = $this->ownerRepository->delete($id);

        return response()->json([
            'status' => 200,
            'message' => $message
        ]);
    }
}
