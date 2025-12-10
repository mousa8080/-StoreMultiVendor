<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginAdminController extends Controller
{
    
    public function loginAdmin(Request $request){
        // Login admin logic here
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        // Attempt to authenticate the admin
        if (!auth()->guard('admin')->attempt($request->only('email', 'password'))) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid credentials',
            ], 401);    
        }
        $admin = auth()->guard('admin')->user();
        $token = $admin->createToken('admin-token', ['admin'])->plainTextToken;
        return response()->json([
            'status' => 'success',
            'admin' => $admin,
            'token' => $token,
        ], 200);

    }
}
