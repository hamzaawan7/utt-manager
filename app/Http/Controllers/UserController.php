<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /** @var UserRepositoryInterface $userRepository */
    private $userRepository;

    public function __construct(UserRepositoryInterface  $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return Application|Factory|View
     */
    public function list()
    {
        $roles       = Role::all();
        $permissions = Permission::all();
        $users = $this->userRepository->all();

        return view('user.user_list',compact('roles','users','permissions'));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function saveUserRole(Request $request): JsonResponse
    {
       $response = $this->userRepository->save($request->input());

        return response()->json($response);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function edit(int $id)
    {
        $users = $this->userRepository->edit($id);

        return response()->json($users);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        $this->userRepository->delete($id);

        return response()->json("Data Deleeted Successfully");
    }
}

