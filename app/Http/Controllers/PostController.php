<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{

    // METHOD FOR BOTH EDITOR AND ADMIN ROLE START HERE
    public function list($userId = null)
    {


        $user = Auth::user();

        // return $user;

        if(!$user){
            return redirect()->back()->with('message', 'You are not authorised to access this page !');
        }elseif($user->status !== 1){
            return redirect()->back()->with('error', 'Your account is deactivated please contact to support!');
        }

        if ($user->role === 'editor') {
            if ($userId) {
                $questions = Post::where('user_id', $userId)->orderBy('id', 'DESC')->paginate(10);

            } else {
                $questions = Post::orderBy('id', 'DESC')->paginate(10);
            }

            return view('editor.pages.questions.list', compact('questions'));
        } elseif ($user->role === 'admin') {
            $questions = Post::orderBy('id', 'DESC')->paginate(10);

            return view('admin.pages.question.list', ['questions' => $questions]);
        }elseif($user->role === 'user'){
            $questions = Post::orderBy('id', 'DESC')->paginate(10);
            return view('user.pages.questions.list', ['questions' => $questions]);
        }

        return redirect()->back()->with('message', 'You are authorised to access this');
    }

    public function questionCreate()
    {

        $user = Auth::user();

        if ($user->role === 'admin') {
            return view('admin.pages.question.create');
        } elseif ($user->role === 'editor') {
            return view('editor.pages.questions.create');
        }
    }

    public function questionStore(Request $request)
    {

        $user = Auth::user();

        if (!$user) {
            abort(403);
        } else {
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
            $post->tags = json_encode($tags);
            $post->body = $request->input('body', null);
            $post->save();

            if ($user->role === 'editor') {
                return redirect()->route('question.list')->with('success', 'Question posted successfully.');
            } elseif ($user->role === 'admin') {
                return redirect()->route('question.list')->with('success', 'Question posted successfully.');
            }
        }
    }

    public function questionEdit($id)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->back()->with('message', 'You are authorised to access this');
        } else {
            if ($user->role === 'editor') {
                $question = Post::findOrFail($id);
                return view('editor.pages.questions.edit', ['question' => $question]);
            } elseif ($user->role === 'admin') {
                $question = Post::findOrFail($id);
                return view('admin.pages.question.edit', compact('question'));
            }
        }
    }

    public function questionUpdate(Request $request, $id)
    {
        $user = Auth::user();

        if (!$user) {
            abort(403);
        } else {
            $question = Post::findOrFail($id);
            $request->validate([
                'title' => 'required|string|max:255',
                'tags' => 'nullable|string',
            ]);

            $question->title = $request->input('title');
            $tags = $request->input('tags-hidden');
            $question->tags = $tags;

            $question->save();

            if ($user->role === 'editor') {
                return redirect()->route('question.list')->with('message', 'Question Updated Successfully !');
            } elseif ($user->role === 'admin') {
                return redirect()->route('question.list')->with('message', 'Question Updated Successfully !');
            }
        }
    }

    public function questionDelete($id)
    {
        // Find the question by ID
        $question = Post::findOrFail($id);

        // delete the related answers
        $question->answers()->delete();

        // Delete the question
        $question->delete();

        $user = Auth::user();

        if ($user->role === 'editor') {
            return redirect()->route('question.list')->with('message', 'Question Updated Successfully !');
        } elseif ($user->role === 'admin') {
            return redirect()->route('question.list')->with('message', 'Question Updated Successfully !');
        }
    }

    // METHOD FOR BOTH EDITOR AND ADMIN ROLE END HERE

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

    public function updatePost(Request $request, $id)
    {
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
