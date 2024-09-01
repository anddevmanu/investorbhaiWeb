<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.pages.dashboard');
    }

    public function userList()
    {
        $users = User::paginate(10);

        return view('admin.pages.user.list', ['users' => $users]);
    }

    public function userEdit($id)
    {
        $user = null;
        if ($id) {
            $user = User::where(['id' => $id])->first();
        }

        if (!$user) {
            // throw new Exception("User not found", );
            abort(404);
        }

        return view('admin.pages.user.edit', compact('user'));
    }

    public function userDelete($id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Delete the user
        $user->delete();

        // Redirect to the user list with a success message
        return redirect()->route('user.list')->with('success', 'User deleted successfully.');
    }

    public function userupdate(Request $request, User $user)
    {

        // Determine if the email has changed
        $ignoreEmailValidation = $request->email === $user->email ? $user->id : null;

        $request->validate([
            'name' => 'required|max:255',
            'phone' => ['nullable', 'numeric', 'digits_between:10,15', Rule::unique('users', 'phone')->ignore($user->id)],
            'role' => 'required',
            'status' => 'required|boolean'

        ]);

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->role = $request->role;
        $user->status = $request->filled('status') ? 1 : 0;

        $user->save();

        return redirect(route('user.list'))->with("success", "User updated successfully.");
    }

    public function questionList()
    {

        $questions = Post::paginate(10);

        return view('admin.pages.question.list', ['questions' => $questions]);
    }

    public function questionCreate()
    {

        return view('admin.pages.question.create');
    }

    public function questionStore(Request $request)
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
        $post->tags = json_encode($tags);
        $post->body = $request->input('body', null);
        $post->save();

        return redirect()->route('admin.question.list')->with('success', 'Question posted successfully.');
    }

    public function questionEdit($id)
    {

        $question = Post::findOrFail($id);
        return view('admin.pages.question.edit', compact('question'));
    }

    public function questionUpdate(Request $request, $id)
    {

        $question = Post::findOrFail($id);

        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'tags' => 'nullable|string',
        ]);

        $question->title = $request->input('title');

        $tags = $request->input('tags-hidden');

        $question->tags = $tags;

        $question->save();

        return redirect()->route('admin.question.list')->with('success', 'Question updated successfully.');
    }

    public function questionDelete($id)
    {
        // Find the question by ID
        $question = Post::findOrFail($id);

        // Delete the question
        $question->delete();

        return redirect()->route('admin.question.list')->with('success', 'Question deleted successfully.');
    }
}
