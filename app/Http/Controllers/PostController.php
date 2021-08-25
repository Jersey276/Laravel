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
        $post = new Post();
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->text = $request->text;
        $post->id_user = (Auth::user())->id;
        $post->save();
        return redirect('/admin/posts/'.$post->title);
    }

    public function createForm()
    {
        return view('/admin/posts/form');
    }

    public function edit(Request $request, int $id)
    {
        Post::find($id)->update([
        'title' => $request->title,
        'slug' => $request->slug,
        'text' => $request->text
        ]);
        return redirect((Post::find($id))->displayLink(true));
    }

    public function editForm(int $id)
    {
        return view('/admin/posts/form',['post' => Post::findOrFail($id)]);
    }

    public function remove(int $id)
    {
        (Post::findOrFail($id))->delete();
        return redirect('/admin/posts/');
    }
}
