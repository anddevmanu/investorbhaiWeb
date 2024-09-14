<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Contact;
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

    public function enquiryList(){

        $enquiries = Contact::orderBy('id', 'DESC')->paginate(10);

        return view('admin.pages.enquiryList', compact('enquiries'));
    }

    public function deleteEnquiry(Request $request, $id){

             $enquiry = Contact::find($id);

            if (!$enquiry) {
                return redirect()->back()->withErrors('Selected enquiry is not available')->withInput();
            }

            $enquiry->delete();

                return redirect()->back()->with('success', 'Enquiry Deleted Successfully !');
         }
}
