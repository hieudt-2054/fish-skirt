<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function index()
    {
        return Post::with('category')->get();
    }

    public function store(Request $req)
    {
        return Post::create([
            'title' => $req->title,
            'post_type' => (int) $req->post_type,
            'post_image_path' => $req->post_image_path,
            'category_id' => $req->category_id,
            'body' => $req->post_type == 0 ? $req->editorData : $req->youtubeScript,
        ]);
    }

    public function show(Post $post)
    {
        return response()->json(['data' => $post]);
    }

    public function update(Post $post, Request $req)
    {
        try {
            $stt = $post->update([
                'title' => $req->title,
                'post_type' => (int) $req->post_type,
                'post_image_path' => $req->post_image_path,
                'category_id' => $req->category_id,
                'body' => $req->post_type == 0 ? $req->editorData : $req->youtubeScript,
            ]);

            return response()->json(['status' => $stt]);
        } catch (\Exception $ex) {
            return response()->json(['status' => 'error'], 500);
        }
    }
}
