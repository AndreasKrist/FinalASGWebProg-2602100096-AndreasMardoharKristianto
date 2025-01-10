@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-8 rounded shadow">
    <h2 class="text-2xl font-bold mb-6">Payment</h2>

    @if(session('message'))
        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4">
            {{ session('message') }}
            <form method="POST" action="{{ route('payment.process') }}">
                @csrf
                <input type="hidden" name="amount" value="{{ request()->input('amount') }}">
                <input type="hidden" name="convert_to_coins" value="1">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded mt-2">Convert to Coins</button>
            </form>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('payment.process') }}">
        @csrf
        <div class="mb-4">
            <label class="block mb-2">Required Amount</label>
            <input type="text" value="{{ $user->payment_amount }}" class="w-full px-3 py-2 border rounded" readonly>
        </div>

        <div class="mb-4">
            <label class="block mb-2">Enter Payment Amount</label>
            <input type="number" name="amount" class="w-full px-3 py-2 border rounded" required>
        </div>

        <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded">Process Payment</button>
    </form>
</div>
@endsection