<?php

namespace App;

use App\Like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }

    public function test($tweet) {
        $query = Like::query();
        $query->where('tweet_id', $tweet->id);
        $query->where('user_id', Auth::user()->id);

        if ($query->count() == 0) {
            return $query;
        } else {
            return 1;
        }
        
    } 
}
