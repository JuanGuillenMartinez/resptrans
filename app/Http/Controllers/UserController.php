<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\JsonResponse;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        return JsonResponse::sendResponse(User::all());
    }

    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'job_title' => $request->job_title,
            'password' => bcrypt($request->password),
        ]);
        $user->assignRole(Role::find($request->rol_id));
        return JsonResponse::sendResponse($user);
    }

    public function show($id)
    {
        return JsonResponse::sendResponse(User::query()->find($id));
    }

    public function destroy($id)
    {
        return JsonResponse::sendResponse(User::find($id)->delete());
    }

    public function assignPermissions(Request $request, $id)
    {
        $user = User::find($id);
        foreach ($request->permission_ids as $permissionId) {
            $permission = Permission::find($permissionId);
            if (!$user->hasPermissionTo($permission))
                $user->givePermissionTo($permission);
        }
        return response()->noContent();
    }

    public function permissions($id)
    {
        return JsonResponse::sendResponse(User::find($id)->load(['permissions'])->permissions);
    }
}
