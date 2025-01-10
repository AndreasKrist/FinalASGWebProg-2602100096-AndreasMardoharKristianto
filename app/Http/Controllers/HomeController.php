<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', auth()->id())->get();
        return view('home', compact('users'));
    }

    public function like(User $user)
    {
        auth()->user()->likes()->toggle($user->id);
        return back();
    }

    public function addCoins()
    {
        $user = auth()->user();
        $user->coins += 100;
        $user->save();
        return back();
    }

    public function search(Request $request)
    {
        $query = User::where('id', '!=', auth()->id());

        if ($request->has('gender')) {
            $query->where('gender', $request->gender);
        }

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('hobbies', 'like', "%{$search}%");
            });
        }

        $users = $query->get();
        return view('home', compact('users'));
    }
}
