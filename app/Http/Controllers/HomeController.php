<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the home page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $post = Post::all()->last();
        return view('home', ['post' => $post]);
    }

    /**
     * Show the admin home page
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminIndex()
    {
        return view('admin/home');
    }
}
