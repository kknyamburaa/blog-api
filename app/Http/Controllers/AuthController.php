<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
     $user = User::create([
        'name' => $request->validated('name'),
        'email' => $request->validated('email'),
        'password' => Hash::make($request->validated('password')),
     ]);
     if ($user) {
        return response()->json([
            'message' => 'User created successfully',
            'user' => new UserResource($user),
        ], 201);
     }   
    }
   
    public function login(LoginRequest $request)
    {
     $user = User::where('email', $request->validated('email'))->first();
     if (!$user || !Hash::check($request->validated('password'), $user->password)) {
        return response()->json([
            'message' => 'invalid credentials',
        ], 401);
     }   
     $token = $user->createToken('auth-token')->plainTextToken;
     return response()->json([
        'user' => new UserResource($user),
        'token' => $this->resource[$token],
     ]);
    }
}
