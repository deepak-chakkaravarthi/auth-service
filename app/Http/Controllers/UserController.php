<?php

// app/Http/Controllers/UserController.php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['user' => $user], 201);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return response()->json(['user' => $user]);
    }

    public function delete($id)
    {
        User::destroy($id);
        return response()->json(['message' => 'User deleted successfully']);
    }


    public function getUserDetails($id)
{
    try {
        // Fetch user with roles and permissions
        $user = User::with('roles.permissions')->find($id);

        // Check if user exists
        if (!$user) {
            return response()->json([
                'message' => 'User not found',
            ], 404);
        }

        // Return user details
        return response()->json([
            'message' => 'User details retrieved successfully',
            'user' => $user,
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'An error occurred',
            'error' => $e->getMessage(),
        ], 500);
    }
}
}

