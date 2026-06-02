<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Resources\CommentResource;
use App\Http\Requests\StoreCommentRequest;
use Illuminate\Http\Request;

class CommentController extends Controller
{
   public function index()
   {
    return CommentResource::collection(Comment::all());
   }
   
   public function store(StoreCommentRequest $request)
   {
    $comment = Comment::create([
        'post_id' => $request->post_id,
        'user_id' => auth()->id(),
        'content' => $request->content,
    ]);
    return new CommentResource($comment)
              ->response()
              ->setStatusCode(201);
   }
   
   public function destroy($id)
   {
    $comment = Comment::findOrFail($id);
    $comment->delete();
    return response()->json(null, 204);
   }
}
