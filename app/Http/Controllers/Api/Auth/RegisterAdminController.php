<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class RegisterAdminController extends Controller
{
    // Registration logic for admin can be added here
    public function register(Request $request)
    {
        // Validate and create admin user
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'phone_number' => 'required|string|max:20|unique:admins',
            'username' => 'required|string|max:50|unique:admins',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]); 
        return response()->json([
            'status' => 'success',
            'message' => 'Admin created successfully',
            'admin' => [
                'id' => $admin->id,
                'name' => $admin->name,
                'email' => $admin->email,
                'phone_number' => $admin->phone_number,
                'username' => $admin->username,
            ],
        ], 201);
    }


}
