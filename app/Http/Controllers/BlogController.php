<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Seo;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class BlogController extends Controller
{
    public function blogList()
    {
        $blogs = Blog::with('category')->paginate(10);

        $user = Auth::user();

        // Redirect based on user role
        if ($user->role === 'editor') {
            return view('editor.pages.blog.list', compact('blogs'));
        } elseif ($user->role === 'admin') {
            return view('admin.pages.blog.list', compact('blogs'));
        }

        return abort(403, 'Unauthorized action.');
    }

    public function bloglistFinal($userId = null)
    {
        $user = Auth::user();

        if ($user->role === 'editor') {
            if ($userId) {
                $blogs = Blog::with('category')->where('user_id', $userId)->paginate(10);
            } else {
                $blogs = Blog::with('category')->paginate(10);
            }
            return view('editor.pages.blog.list', compact('blogs'));
        } elseif ($user->role === 'admin') {
            $blogs = Blog::with('category')->paginate(10);

            return view('admin.pages.blog.list', compact('blogs'));
        }

        return abort(403, 'Unauthorized action.');
    }


    public function createBlog()
    {

        $categories = Category::where('status', 1)->get();

        $user = Auth::user();

        if ($user->role === 'editor') {
            return view('editor.pages.blog.create', compact('categories'));
        } elseif ($user->role === 'admin') {
            return view('admin.pages.blog.create', compact('categories'));
        }

        return abort(403, 'Unauthorized action.');
    }


    public function storeBlog(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|exists:tbl_categories,id',
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tags' => 'required|string',
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '-' . $image->getClientOriginalName();
            $destinationPath = public_path('/uploads/blog');
            $image->move($destinationPath, $imageName);
            $imagePath = 'uploads/blog/' . $imageName;
        }

        $blog = Blog::create([
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title')),
            'description' => $request->input('description'),
            'category_id' => $request->input('category'),
            'user_id' => auth()->id(),
            'image' => $imagePath,
            'tags' => $request->input('tags'),
        ]);

        Seo::create([
            'blog_id' => $blog->id,
            'meta_title' => $request->input('meta_title'),
            'meta_description' => $request->input('meta_description'),
            'meta_keywords' => $request->input('meta_keywords'),
        ]);



        return redirect()->route('blog.list')->with('success', 'Blog Created Successfully !');
    }

    public function editBlog($id)
    {
        $categories = Category::where('status', 1)->get();

        $blog = Blog::with('seo')->findOrFail($id);

        // return $blog;

        $user = Auth::user();

        if ($user->role === 'editor') {
            return view('editor.pages.blog.edit', compact('categories', 'blog'));
        } elseif ($user->role === 'admin') {
            return view('admin.pages.blog.edit', compact('categories', 'blog'));
        }

        return abort(403, 'Unauthorized action.');
    }

    public function updateBlog(Request $request, $id)
    {

        $user = Auth::user();

        if(!$user){
            return redirect()->back()->with('error', 'You are not Authorised to perferom this action !');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|exists:tbl_categories,id',
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tags' => 'required|string',
        ]);

        // return "validation passed";

        $blog = Blog::findOrFail($id);

        if ($request->hasFile('image')) {

            if ($blog->image && file_exists(public_path('uploads/blog/' . $blog->image))) {
                unlink(public_path('uploads/blog/' . $blog->image));
            }

            // Upload the new image
            $image = $request->file('image');
            $imageName = time() . '-' . $image->getClientOriginalName();
            $destinationPath = public_path('/uploads/blog');
            $image->move($destinationPath, $imageName);
            $imagePath = 'uploads/blog/' . $imageName;

            $blog->image = $imagePath;
        }

        $blog->title = $request->input('title');
        $blog->category_id = $request->input('category');
        $blog->description = $request->input('description');
        $blog->tags = $request->input('tags');
        $blog->save();

        // Update the associated SEO data
        $seo = $blog->seo()->updateOrCreate(
            ['blog_id' => $blog->id],
            [
                'meta_title' => $request->input('meta_title'),
                'meta_keywords' => $request->input('meta_keywords'),
                'meta_description' => $request->input('meta_description'),
            ]
        );



        if($user->role === 'admin'){
            return redirect()->route('blog.list')->with('success', 'Blog updated successfully!');
        }elseif($user->role === 'editor'){
            return redirect()->route('blog.list')->with('success', 'Blog updated successfully!');
        }

    }

    public function deleteBlog($id)
    {

        $blog = Blog::findOrFail($id);

        // Check if the blog has an image and if the file exists
        if ($blog->image && file_exists(public_path('uploads/blog/' . $blog->image))) {
            unlink(public_path('uploads/blog/' . $blog->image));
        }

        // Delete related SEO records (assuming there's a seo relationship)
        $blog->seo()->delete();

        // Delete the blog
        $blog->delete();
        $user = Auth::user();

        if ($user->role === 'editor') {
            return redirect()->route('blog.list')->with('success', 'Blog deleted successfully');
        }

        return redirect()->route('blog.list')->with('success', 'Blog deleted successfully');
    }
}
