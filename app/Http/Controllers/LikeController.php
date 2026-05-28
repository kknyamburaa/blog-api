<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store($id)
    {
        $like = Like::create([
            'post_id' => $id,
            'user_id' => auth()->id(),
        ]);
        return response()->json($like, 201);
    }
    
    public function destroy($id)
    {
        $like = Like::where('post_id', $id)->where('user_id', auth()->id())->first();
        $like->delete();
        return response()->json(null, 204);
    }
}
