<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\PasswordResetEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }
    
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Find the user by email
        $user = User::where('email', $request->email)->first();

        if ($user) {
            // Create a password reset token
            $token = Password::createToken($user);
            
            // Send your custom password reset email
            Mail::to($user->email)->send(new PasswordResetEmail($user, $token));

            return back()->with('status', trans(Password::RESET_LINK_SENT));
        }

        return back()->withErrors(['email' => trans(Password::INVALID_USER)]);
    }
}

