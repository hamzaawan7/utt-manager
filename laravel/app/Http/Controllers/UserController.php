<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function list()
    {
        $roles       = Role::all();
        $permissions = Permission::all();

        return view('user_list',compact('roles','permissions'));
    }

    /**
     * @param Request $request
     * @return void
     */
    public function saveUserRole(Request $request)
    {
        $user = new User;
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->password = $request->password;
        $user->save();
        $user->syncRoles($request->role);
        $role = Role::find($request->role);
        $role->givePermissionTo($request->permission);

    }
}

