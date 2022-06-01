<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\CustomerSaveRequest;
use App\Repositories\CustomerRepositoryInterface;
use Illuminate\Http\Request;
use DataTables;

/**
 * Class CustomerController
 * @package App\Http\Controllers
 */
class CustomerController extends Controller
{

    /** @var CustomerRepositoryInterface $customerRepository */
    private $customerRepository;

    public function __construct(CustomerRepositoryInterface  $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('customer.customer_list');
    }

    /**
     * @param Request $request
     * @return void
     */
    public function getCustomer(Request $request)
    {
        if ($request->ajax()) {
            $customerList = $this->customerRepository->all();
            return Datatables::of($customerList)
                ->addIndexColumn()
                ->addColumn('action', function($customerList){
                    $actionBtn = '
                                  <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#"
                                   role="button" data-toggle="dropdown">
                                    <i class="dw dw-more"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                    <a class="dropdown-item reset_form" href="#" onclick="editCustomer(\'/customer/edit/'.$customerList->id.'\')">
                                        <i class="dw dw-edit2"></i> Edit
                                    </a>
                                    <a class="dropdown-item btn-delete" onclick="deleteCustomer(\'/customer/delete/'.$customerList->id.'\')">
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
     * @param CustomerSaveRequest $request
     * @return JsonResponse
     */
    public function save(CustomerSaveRequest $request): JsonResponse
    {
        $category = $this->customerRepository->save($request->input());
        if ($category) {
            return response()->json([
                'status'=>200,
                'message'=>$category
                ]);
        }
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function edit(int $id): JsonResponse
    {
        $response = $this->customerRepository->edit($id);
        $response->user;
        return response()->json($response);

    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        $response = $this->customerRepository->update($request->input());
        if ($response) {
            return response()->json($response);
        }

        return response()->json("Error While Updating Data");
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function delete($id): JsonResponse
    {
        $response = $this->customerRepository->delete($id);
        if ($response){
            return response()->json([
                'status'=>200,
                'message'=>$response
                ]);
        }
    }
}
