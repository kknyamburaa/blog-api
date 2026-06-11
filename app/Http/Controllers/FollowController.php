<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    // Follow a user
    public function follow(User $user)
    {
        $currentUser = auth()->user();
        
        if (!$currentUser) {
            return response()->json([
                'error' => 'You must be logged in to follow users.'
            ], 401);
        }
         // Cannot follow yourself
        if ($currentUser->id === $user->id) {
            return response()->json([
                'error' => 'You cannot follow yourself.'
            ], 400);
        }
        
        $currentUser->following()->attach($user->id);
        return response()->json([
            'message' => "i love you bitch"
        ]);
    }

    // Unfollow a user
    public function unfollow(User $user)
    {
        $currentUser = auth()->user();
        
        $currentUser->following()->detach($user->id);
        
        return response()->json([
            'message' => "i hate you bitch"
        ]);
    }
    // Show user's followers
    public function followers(User $user)
    {
        $followers = $user->followers()->paginate(20);
        
        return response()->json([
            'followers' => $followers
        ]);
    }

    // Show user's following
    public function following(User $user)
    {
        $following = $user->following()->paginate(20);
        
        return response()->json([
            'following' => $following
        ]);
    }
}