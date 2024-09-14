<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->back()->with('info', 'Login to access this page !');
        } elseif ($user->status !== 1) {
            return redirect()->back()->with('warning', 'Your account is inactive Contact support to activate !');
        }

        if ($user->role === 'admin') {
            return view('admin.pages.profile.profile', compact('user'));
        } elseif ($user->role === 'editor') {
            return view('editor.pages.profile.profile', compact('user'));
        } else {
            return view('user.pages.profile.profile', compact('user'));
        }
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|numeric|digits_between:10,15',
            'profile_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Update user details
        $user->name = $request->input('name');
        $user->phone = $request->input('phone');

        // Handle profile image upload
        if ($request->hasFile('profile_img')) {
            // Delete the old profile image if it exists
            if ($user->profile_img && file_exists(public_path('uploads/user/' . basename($user->profile_img)))) {
                unlink(public_path('uploads/user/' . basename($user->profile_img)));
            }

            // Store new image and save the path
            $image = $request->file('profile_img');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/user'), $imageName);

            $user->profile_img = 'uploads/user/' . $imageName;
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function changePassword(){
        $user = Auth::user();

        if (!$user) {
            return redirect()->back()->with('info', 'Login to access this page !');
        } elseif ($user->status !== 1) {
            return redirect()->back()->with('warning', 'Your account is inactive Contact support to activate !');
        }

        if($user->role === 'admin'){
            return view('admin.pages.profile.change-password');
        }elseif($user->role === 'editor'){
            return view('editor.pages.profile.change-password');
        }else{
            return view('user.pages.profile.change-password');
        }
    }

    public function updatePassword(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $user = Auth::user();


        if (!Hash::check($request->input('current_password'), $user->password)) {
            return Redirect::back()->withErrors(['current_password' => 'Current password is incorrect'])->withInput();
        }

        // Update the password
        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        // Redirect with success message
        return Redirect::back()->with('success', 'Password changed successfully');
    }
}
