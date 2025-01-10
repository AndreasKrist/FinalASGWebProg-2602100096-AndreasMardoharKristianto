@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-8 rounded shadow">
    <h2 class="text-2xl font-bold mb-6">Register</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-4">
            <label class="block mb-2">Name</label>
            <input type="text" name="name" class="w-full px-3 py-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label class="block mb-2">Email</label>
            <input type="email" name="email" class="w-full px-3 py-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label class="block mb-2">Gender</label>
            <select name="gender" class="w-full px-3 py-2 border rounded" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block mb-2">Hobbies (Select at least 3)</label>
            <div class="space-y-2">
                <label class="flex items-center">
                    <input type="checkbox" name="hobbies[]" value="Reading">
                    <span class="ml-2">Reading</span>
                </label>
                <label class="flex items-center">
                <input type="checkbox" name="hobbies[]" value="Writing">
                    <span class="ml-2">Writing</span>
                </label>
                <label class="flex items-center">
                    <input type="checkbox" name="hobbies[]" value="Gaming">
                    <span class="ml-2">Gaming</span>
                </label>
                <label class="flex items-center">
                    <input type="checkbox" name="hobbies[]" value="Sports">
                    <span class="ml-2">Sports</span>
                </label>
                <label class="flex items-center">
                    <input type="checkbox" name="hobbies[]" value="Music">
                    <span class="ml-2">Music</span>
                </label>
                <label class="flex items-center">
                    <input type="checkbox" name="hobbies[]" value="Cooking">
                    <span class="ml-2">Cooking</span>
                </label>
            </div>
        </div>

        <div class="mb-4">
            <label class="block mb-2">Instagram Username</label>
            <input type="text" name="instagram_username" class="w-full px-3 py-2 border rounded" required>
            <small class="text-gray-500">Without '@' symbol</small>
        </div>

        <div class="mb-4">
            <label class="block mb-2">Mobile Number</label>
            <input type="text" name="mobile_number" class="w-full px-3 py-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label class="block mb-2">Password</label>
            <input type="password" name="password" class="w-full px-3 py-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label class="block mb-2">Confirm Password</label>
            <input type="password" name="password_confirmation" class="w-full px-3 py-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label class="block mb-2">Payment Amount</label>
            <input type="text" name="payment_amount" class="w-full px-3 py-2 border rounded" value="{{ rand(100000, 125000) }}" readonly>
        </div>

        <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded">Register</button>
    </form>
</div>
@endsection