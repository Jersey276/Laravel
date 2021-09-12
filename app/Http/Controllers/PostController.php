<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        
    }

    public function index()
    {
        return view('posts/list',['posts' => Post::all()]);
    }

    public function adminIndex()
    {
        return view('admin/posts/list',['posts' => Post::all()]);
    }
    
    public function detail(string $title)
    {
        return view('posts/detail',['post' => Post::where(['title' => $title])->firstOrFail()]);
    }

    public function create(Request $request)
    {
        $post = new Post([
            'title' => $request->title,
            'slug' => $request->slug,
            'text' => $request->text
        ]);
        $post->author()->associate(Auth::user());
        if($post->save()) {
            $this->successFlash($request, 'Le post à été crée');
        } else {
            $this->errorFlash($request, 'Le post n\'a pu être crée');
        }
        return redirect('/admin/posts/');
    }

    public function createForm()
    {
        return view('/admin/posts/form');
    }

    public function edit(Request $request, int $id)
    {
        /** @var Post $post */
        $post = Post::find($id);
        if ($post->update([
        'title' => $request->title,
        'slug' => $request->slug,
        'text' => $request->text
        ])) {
            $this->successFlash($request, 'Le post '. $post->title.' à été mis à jour');
        } else {
            $this->errorFlash($request, 'Le post '. $post->title.' n\'a pu être mis à jour');
        }
        return redirect((Post::find($id))->displayLink(true));
    }

    public function editForm(int $id)
    {
        $this->authorize('update',Post::findOrFail($id));
        return view('/admin/posts/form',['post' => Post::findOrFail($id)]);
    }

    public function remove(int $id, Request $request)
    {
        /** @var Post $post */
        $post = Post::findOrFail($id);
        if ($post->delete()) {
            $this->successFlash($request, 'Le post '. $post->title.' à été supprimé');
        } else {
            $this->errorFlash($request, 'Le post '. $post->title.' n\'a pu être supprimé');
        }
        return redirect('/admin/posts/');
    }
}
