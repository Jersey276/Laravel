<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(String $title, Request $request)
    {
        /** @var Post $post */
        $post = Post::firstWhere('title', $title);
        /** @var User $user */
        $user = Auth::user();
        $comment = new Comment([
            'comment' => $request->comment,
        ]);
        $comment->author()->associate($user);
        $comment->post()->associate($post);
        $comment->save();
        
        return redirect($post->displayLink());
    }

    public function edit(String $title, Request $request)
    {
        
    }

    public function remove(String $title)
    {

    }
}
