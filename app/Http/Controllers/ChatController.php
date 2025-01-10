<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function show(User $user)
    {
        $chats = Chat::where(function($query) use ($user) {
            $query->where('sender_id', auth()->id())
                  ->where('receiver_id', $user->id);
        })->orWhere(function($query) use ($user) {
            $query->where('sender_id', $user->id)
                  ->where('receiver_id', auth()->id());
        })->orderBy('created_at', 'asc')->get();

        return view('chat', compact('user', 'chats'));
    }

    public function send(Request $request, User $user)
    {
        $validated = $request->validate([
            'message' => 'required|string'
        ]);

        Chat::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $user->id,
            'message' => $validated['message']
        ]);

        return back();
    }
}
