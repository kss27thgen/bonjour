<?php

namespace App\Http\Controllers;

use App\Like;
use App\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikesController extends Controller
{
    public function store(Tweet $tweet) {
        $like['tweet_id'] = $tweet->id;
        $like['user_id'] = Auth::user()->id;
        Like::create($like);

        return redirect()->back();
    }

    public function destroy(Tweet $tweet) {
        $like = Like::where('tweet_id', $tweet->id)->where('user_id', Auth::user()->id);

        $like->delete();
        return redirect()->back();
    }
}
