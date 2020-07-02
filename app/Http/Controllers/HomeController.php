<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::where('post_type', 0)->orderBy('created_at', 'DESC')->get();
        $postsVideo = Post::where('post_type', 1)->orderBy('created_at', 'DESC')->get();
        // dd($postsVideo);
        return view('front.home', compact(['posts', 'postsVideo']));
    }

    public function show(Post $post)
    {
        $newPosts = Post::orderBy('created_at', 'DESC')->take(5)->get();
        $related = Post::where('category_id', $post->category_id)->where('id', '!=', $post->id)->orderBy('created_at', 'DESC')->take(4)->get();

        return view('front.single', compact(['post', 'newPosts', 'related']));
    }

    public function postsInCategory(Category $category)
    {
        $posts = $category->posts()->orderBy('created_at', 'DESC')->get();
        
        return view('front.category', compact(['posts', 'category']));
    }
}
