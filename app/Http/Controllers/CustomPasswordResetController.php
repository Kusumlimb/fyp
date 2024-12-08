<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class CustomPasswordResetController extends Controller
{
    public function create()
    {
        return view('auth.forgot-password'); // Use Laravel's default "forgot-password" view
    }

    public function store(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Check if the email exists in the database
        $user = \App\Models\User::where('email', $request->input('email'))->first();

        if (!$user) {
            return back()->with('status', 'If the email exists, a reset link has been sent!');
        }

        // Generate a secure reset link (using base64 encoding for simplicity here, you can use Laravel's Password facade)
        $email = $request->input('email');
        $resetLink = url('/reset-password/' . base64_encode($email)); // Modify this URL based on your routing

        // Send the reset link via Mail::raw
        Mail::raw("Click the link to reset your password: $resetLink", function ($message) use ($email) {
            $message->to($email)
                    ->subject('Password Reset Link');
        });

        return back()->with('status', 'Password reset link sent to your email!');
    }
}
