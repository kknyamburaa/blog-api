<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
   public function index()
   {
    return response()->json(Comment::all());
   }
   
   public function store(Request $request)
   {
    $comment = Comment::create([
        'post_id' => $request->post_id,
        'user_id' => auth()->id(),
        'content' => $request->content,
    ]);
    return response()->json($comment, 201);
   }
   
   public function destroy($id)
   {
    $comment = Comment::find($id);
    $comment->delete();
    return response()->json(null, 204);
   }
}
