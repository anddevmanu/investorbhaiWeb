<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;


class CommentController extends Controller
{


    public function saveComment(Request $request)
    {

        // Validate the request based on the type of content (post, answer, or blog)
        $validatedData = $request->validate([
            'type' => 'required|in:post,answer,blog', // Ensure the type is either post, answer, or blog
            'body' => 'required',
            'post_id' => 'nullable|required_if:type,post|exists:tbl_posts,id',
            'answer_id' => 'nullable|required_if:type,answer|exists:tbl_answers,id',
            'blog_id' => 'nullable|required_if:type,blog|exists:tbl_blogs,id',
        ]);

        $user = Auth::user();

        // Create the comment based on the type
        $comment = Comment::create([
            'user_id' => $user->id,
            'post_id' => $validatedData['type'] == 'post' ? $validatedData['post_id'] : null,
            'answer_id' => $validatedData['type'] == 'answer' ? $validatedData['answer_id'] : null,
            'blog_id' => $validatedData['type'] == 'blog' ? $validatedData['blog_id'] : null,
            'body' => $validatedData['body'],
            'type' => $validatedData['type'], // Set the type (post, answer, or blog)
        ]);

        return redirect()->back()->with('message', 'Your comment has been submitted successfully!');
    }

}
