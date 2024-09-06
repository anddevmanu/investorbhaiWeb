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

    public function editPost(Request $request, $id)
        {
            $question = Post::find($id);

            if (!$question) {
             return redirect()->back()->withErrors(['error' => 'Post not found'])->withInput();
            }

            return view('user.pages.questions.edit-question', ['question' => $question]);
        }

    public function updatePost(Request $request, $id){
        // Find the post or fail if not found
    $post = Post::findOrFail($id);

    // Validate the request data
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'tags-hidden' => 'nullable|string',
    ]);

    // Update the post with validated data
    $post->update([
        'title' => $validatedData['title'],
        'tags' => $validatedData['tags-hidden']
    ]);

    return redirect()->route('home')->with('message', 'Question Updated Successfully!');
    }

}
