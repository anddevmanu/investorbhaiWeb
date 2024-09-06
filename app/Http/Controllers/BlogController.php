<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    public function blogList(){

        $blogs = Blog::get();
        return view('user.pages.blogs', compact('blogs'));
    }
}
