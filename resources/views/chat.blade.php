@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-6">Chat with {{ $user->name }}</h2>

    <div class="h-96 overflow-y-auto mb-6 space-y-4">
        @foreach($chats as $chat)
            <div class="flex {{ $chat->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                <div class="{{ $chat->sender_id === auth()->id() ? 'bg-blue-500 text-white' : 'bg-gray-200' }} rounded-lg px-4 py-2 max-w-xs">
                    <p>{{ $chat->message }}</p>
                    <small class="text-xs">{{ $chat->created_at->format('H:i') }}</small>
                </div>
            </div>
        @endforeach
    </div>

    <form method="POST" action="{{ route('chat.send', $user) }}" class="flex space-x-2">
        @csrf
        <input type="text" name="message" class="flex-1 px-3 py-2 border rounded" placeholder="Type your message..." required>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Send</button>
    </form>
</div>
@endsection