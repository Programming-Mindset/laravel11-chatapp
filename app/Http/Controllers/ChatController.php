<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        return view('chat.index', ['messages' => Message::with('user')->latest()->get()]);
    }

    public function sendMessage(Request $request)
    {
        $request->validate(['message' => 'required']);

        $message = Message::create([
            'user_id' => Auth::id(),
            'message' => $request->message,
        ]);

        broadcast(new MessageSent($message->load('user')))->toOthers();

        return response()->json(['message' => $message]);
    }
}
