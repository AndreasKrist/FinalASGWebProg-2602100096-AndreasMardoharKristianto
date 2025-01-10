<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        return view('payment', compact('user'));
    }

    public function process(Request $request)
    {
        $user = auth()->user();
        
        $validated = $request->validate([
            'amount' => 'required|numeric|min:' . $user->payment_amount
        ]);

        $excess = $validated['amount'] - $user->payment_amount;

        if ($excess > 0) {
            if ($request->has('convert_to_coins')) {
                $user->coins += $excess;
                $user->payment_status = true;
                $user->save();
                return redirect()->route('home');
            }
            return back()->with('message', 'Would you like to convert the excess to coins?')
                        ->with('excess', $excess);
        }

        if ($excess < 0) {
            return back()->with('error', 'Payment amount is insufficient');
        }

        $user->payment_status = true;
        $user->save();
        return redirect()->route('home');
    }
}
