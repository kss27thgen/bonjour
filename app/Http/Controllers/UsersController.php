<?php

namespace App\Http\Controllers;

use App\User;
use App\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function show(User $user) {
        $tweets = $user->tweets; 
        return view('user.show', compact('tweets'));
    }

    public function myroom(User $user) {
        $followees = $user->followees;

        $tweets = collect([]);
        
        foreach ($followees as $followee) {
            $tweets->push($followee->tweets);
        }

        $tweets->push(Auth::user()->tweets);

        $tweets = $tweets->flatten();

        return view('user.myroom', compact('tweets'));
    }

    public function follow(User $user) {
        $follow['following_id'] = Auth::id();
        $follow['followed_id'] = $user->id;
        Follow::create($follow);

        return redirect()->back();
    }
}
