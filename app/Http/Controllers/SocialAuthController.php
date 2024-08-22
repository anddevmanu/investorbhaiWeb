<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;


class SocialAuthController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();

            $user = User::firstOrCreate([
                'email' => $socialUser->getEmail(),
            ], [
                'name' => $socialUser->getName(),
                'provider_id' => $socialUser->getId(),
                'provider' => $provider,
                'password' => bcrypt('111'),
            ]);

            // Log in the user
            Auth::login($user);

            Log::info('User logged in with role: ' . $user->role);

            if ($user->role === 'user') {
                return redirect()->route('user');
            } elseif ($user->role === 'editor') {
                return redirect()->route('editor.dashboard');
            } elseif ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                // Fallback, just in case
                return redirect()->route('home')->with('error', 'Role not recognized');
            }
        } catch (\Exception $e) {
            // Handle any exceptions and errors
            return redirect()->route('login')->with('error', 'Failed to login with ' . ucfirst($provider) . ': ' . $e->getMessage());
        }
    }
}
