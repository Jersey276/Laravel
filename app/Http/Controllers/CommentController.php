<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index(int $id)
    {
        return view('/admin/comments/list', ['post' => Post::findorfail($id)]);
    }
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
        if ($comment->save()) {
            $this->successFlash($request, 'le commentaire à été posté avec succès');
        } else {
            $this->errorFlash($request, 'une erreur à empêcher de poster le commentaire');
        }
        
        return redirect($post->displayLink());
    }

    public function remove(int $id, int $commentId)
    {
        (Comment::findorfail($commentId))->delete();
        return redirect('/admin/posts/'.$id.'/comments');
    }
}
