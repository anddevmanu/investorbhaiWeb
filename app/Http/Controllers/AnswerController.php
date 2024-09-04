<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Answer;

class AnswerController extends Controller
{
    // public function __construct() {
    //     $this->middleware('auth');
    // }

    public function saveAnswer(Request $request){
        $validatedData = $request->validate([
            'post_id' => 'required|exists:tbl_posts,id',
            // 'status' => 'required|exists:tbl_posts,status,1',
            'body' => 'required'
        ]);

        $user = Auth::user();

        $answer = Answer::create([
            'user_id' => $user->id,
            'post_id' => $validatedData['post_id'],
            'body' => $validatedData['body'],
        ]);

        return redirect()->back()->with('success', 'Your answer has been submitted successfully!');
    }
}
