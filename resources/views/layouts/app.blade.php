<!DOCTYPE html>
<html>
<head>
    <title>ConnectFriend</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-lg">
        <div class="container mx-auto px-6 py-3">
            <div class="flex justify-between items-center">
                <a href="{{ route('home') }}" class="text-xl font-bold">ConnectFriend</a>
                @auth
                    <div class="flex items-center space-x-4">
                        <span>Coins: {{ auth()->user()->coins }}</span>
                        <form action="{{ route('add.coins') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-2xl bg-green-500 text-white w-8 h-8 rounded-full">+</button>
                        </form>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Logout</button>
                        </form>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-6 py-8">
        @yield('content')
    </main>
</body>
</html>