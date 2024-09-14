<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;


class CommentController extends Controller
{
    public static function middleware(): array
    {
        return [
            'auth',
        ];
    }

    public function saveComment(Request $request){
        // return $request;
        $validatedData = $request->validate([
            'post_id' => 'required',
            'answer_id' => 'required',
            'body' => 'required'    
        ]);

        $user = Auth::user();

        $comment = Comment::create([
            'user_id' => $user->id,
            'post_id' => $validatedData['post_id'],
            'answer_id' => $validatedData['answer_id'],
            'body' => $validatedData['body'],
            'type' => 'answer',
        ]);

        return redirect()->back()->with('success', 'Your Comment has been submitted successfully!');
    }
}
