<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show($slug)
    {
        // Find the post by slug
        $post = Post::where('slug', $slug)->with('answers.user', 'answers.comments')->firstOrFail();

        // return $post;
        return view('user.pages.post.show', compact('post'));
    }

}
