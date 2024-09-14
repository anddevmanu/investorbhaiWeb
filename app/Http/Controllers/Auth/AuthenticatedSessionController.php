<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('user.pages.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    // Attempt to authenticate the user
    if (!Auth::attempt($credentials, $request->filled('remember'))) {
        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }

    // Retrieve the authenticated user
    $user = Auth::user();

    // Check if the user's status is active (or whatever your criteria for login is)
    if ($user->status !== 1) {
        Auth::logout(); // Log out the user
        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate the CSRF token

        throw ValidationException::withMessages([
            'email' => __('auth.disabled'), // Customize this message as needed
        ]);
    }

    // Regenerate the session to prevent fixation attacks
    $request->session()->regenerate();

    Log::info("userDetails", ['authenticated' => $user]);

    // Redirect based on user role
    switch ($user->role) {
        case 'admin':
            return redirect()->route('admin.dashboard');
        case 'editor':
            return redirect()->route('home');
        default:
            return redirect()->route('home');
    }
}


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Log::info('User logging out', ['user_id' => Auth::id()]);

        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Log::info('User logged out and session invalidated', ['user_id' => Auth::id()]);

        return redirect('/');
    }
}
