<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class UserController extends Controller
{

    public function index(Request $request)
    {

        $posts = \App\Models\Post::where('status', 1)->paginate(10);

        if ($request->ajax()) {
            return response()->json($posts);
        }

        return view('user.pages.home', compact('posts'));
    }


    public function createQuestion()
    {
        return view('user.pages.questions.create-question');
    }

    public function storeQuestion(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            // 'tags' => 'nullable|array|max:5',
            'tags.*' => 'string|max:50',
        ]);

        // Retrieve and process tags
        $tags = json_decode($request->input('tags', '[]'), true);

        // Create a new question post
        $post = new Post();
        $post->user_id = auth()->id();
        $post->title = $request->input('title');
        $post->slug = Str::slug($request->input('title'));
        $post->tags = json_encode($tags);  // Store tags in JSON format
        $post->body = $request->input('body', null);
        $post->save();

        return redirect()->back()->with('success', 'Question posted successfully.');
    }


    public function about()
    {
        return view('user.pages.about');
    }

    public function contact()
    {
        return view('user.pages.contact');
    }

    public function blogListShow()
    {
        $blogs = Blog::with('user')->paginate(10);
        // return $blogs;
        return view('user.pages.blogs', compact('blogs'));
    }

    public function blogDetails($slug)
    {
        // Find the blog by its slug
        $blog = Blog::where('slug', $slug)->firstOrFail();

        // Fetch popular blogs
        $popularBlogs = Blog::orderBy('id', 'desc') // Assuming you have a 'views' column to track popularity
            ->take(5) // Fetch top 5 popular blogs
            ->get();

        // Extract tags from the blog
        $allTags = Blog::pluck('tags')->map(function ($tags) {
            return explode(',', $tags);
        })->flatten()->unique()->map('trim');

        // Fetch related blogs based on category (excluding the current blog)
        $relatedBlogs = Blog::where('category_id', $blog->category_id)
            ->where('id', '!=', $blog->id) // Exclude the current blog
            ->take(4) // Fetch up to 4 related blogs
            ->get();

        // Fetch comments for the blog
        $comments = $blog->comments; // Assuming you have a comments relationship defined in the Blog model

        return view('user.blog-details', [
            'blog' => $blog,
            'popularBlogs' => $popularBlogs,
            'allTags' => $allTags,
            'relatedBlogs' => $relatedBlogs,
            'comments' => $comments,
        ]);
    }
}
