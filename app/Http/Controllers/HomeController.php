<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'DESC')->get();

        return view('front.home', compact('posts'));
    }

    public function show(Post $post)
    {
        $newPosts = Post::orderBy('created_at', 'DESC')->get();

        return view('front.single', compact(['post', 'newPosts']));
    }
}
