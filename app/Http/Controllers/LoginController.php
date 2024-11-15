<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function login(Request $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        };

        $token = Auth::user()->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'token' => $token
        ]);
    }
}
