<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BlogController extends Controller
{
    public function blogList(){

        $blogs = Blog::get();
        return view('user.pages.blogs', compact('blogs'));
    }

    public function createBlog(){
        $user = Auth::user();

        if($user->role === 'editor'){
            return view('editor.pages.create_blog');
        }elseif($user->role === 'admin'){
            return view('admin.pages.blog.create');
        }

        return abort(403, 'Unauthorized action.');
    }

    public function storeBlog (Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'tags' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:500',
            'meta_description' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);



    }

}
