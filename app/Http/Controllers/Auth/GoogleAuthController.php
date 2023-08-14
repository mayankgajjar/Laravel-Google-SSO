<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;

class GoogleAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(UserRepository $userRepository)
    {
        $googleUser = Socialite::driver('google')->user();
        // Check if the user exists
        $user = $userRepository->findByGoogleId($googleUser->getId());
        
        if (!$user) {
            // Create a new user if not found
            $full_name = explode(" ",$googleUser->getName());

            $user_array = [
                'google_id' => $googleUser->getId(),
                'first_name' => $full_name[0],
                'last_name' => $full_name[1],
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'password' => Hash::make('123456789'),
                'profile' => $googleUser->getAvatar(),
                'status' => 'Active'
            ];

            $user = $userRepository->create($user_array);
        }
        Auth::login($user);
        return redirect()->intended('/home'); // Redirect after successful login
    }
}
