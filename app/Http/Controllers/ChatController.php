<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Chat;
use App\Events\ChatMessageSent;


class ChatController extends Controller
{
    public function fetchMessages()
    {
        return Chat::with('user')->latest()->take(20)->get();
    }

    public function sendMessage(Request $request)
    {
        $message = Chat::create([
            'user_id' => Auth::id(),
            'message' => $request->message,
        ]);

        broadcast(new ChatMessageSent($message->load('user')))->toOthers();

        return response()->json(['status' => 'Message Sent!']);
    }
}

