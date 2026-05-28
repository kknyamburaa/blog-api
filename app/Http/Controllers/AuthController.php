<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
     $user = user ::where('email', $request->email)->first();
     if ($user) {
        return response()->json(['message' => 'User already exists'], 409);
     }   
    }
    public function login(Request $request)
    {
     $user = user ::where('email', $request->email)->first();
     if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'invalid credentials'], 401);
     }   
     $token = $user->createToken('auth-token')->plainTextToken;
     return response()->json(['user' => $user, 'token' => $token]);
    }
}
