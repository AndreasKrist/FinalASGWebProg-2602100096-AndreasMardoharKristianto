@extends('layouts.app')

@section('content')
<div class="mb-6">
    <form action="{{ route('search') }}" method="GET" class="flex space-x-4">
        <select name="gender" class="px-3 py-2 border rounded">
            <option value="">All Genders</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>
        <input type="text" name="search" placeholder="Search profiles..." class="flex-1 px-3 py-2 border rounded">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Search</button>
    </form>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($users as $user)
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-xl font-bold mb-2">{{ $user->name }}</h3>
        <p class="mb-2">Gender: {{ $user->gender }}</p>
        <p class="mb-2">
            <a href="{{ $user->instagram_username }}" target="_blank" class="text-blue-500">
                {{ $user->instagram_username }}
            </a>
        </p>
        <div class="mb-4">
            <h4 class="font-bold">Hobbies:</h4>
            <ul class="list-disc list-inside">
                @foreach($user->hobbies as $hobby)
                    <li>{{ $hobby }}</li>
                @endforeach
            </ul>
        </div>
        <div class="flex justify-between items-center">
            <form action="{{ route('like.user', $user) }}" method="POST">
                @csrf
                <button type="submit" class="text-red-500">
                    @if(auth()->user()->likes->contains($user))
                        ❤️
                    @else
                        🤍
                    @endif
                </button>
            </form>
            @if(auth()->user()->likes->contains($user) && $user->likes->contains(auth()->user()))
                <a href="{{ route('chat.show', $user) }}" class="bg-blue-500 text-white px-4 py-2 rounded">Chat</a>
            @endif
        </div>
    </div>
    @endforeach
</div>
@endsection