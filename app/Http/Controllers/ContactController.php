<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Send the email to your inbox
        Mail::raw("Message from: {$validated['name']} ({$validated['email']})\n\n{$validated['message']}", function ($message) {
            $message->to('kusumlimbu75@gmail.com') // your email
                    ->subject('New Contact Form Submission');
        });

        return back()->with('status', 'Thank you! Your message has been sent.');
    }
}
