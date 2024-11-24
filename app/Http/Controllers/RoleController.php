<?php

// app/Http/Controllers/RoleController.php
namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function assignRole(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $role = Role::findOrFail($request->role_id);
        $user->assignRole($role);

        return response()->json(['message' => 'Role assigned successfully']);
    }

    public function removeRole(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $role = Role::findOrFail($request->role_id);
        $user->roles()->detach($role);

        return response()->json(['message' => 'Role removed successfully']);
    }
}
