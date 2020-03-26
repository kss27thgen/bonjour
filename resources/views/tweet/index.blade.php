@extends('layouts.app')

@section('content')
    <div class="tweets">

        <ul class="tweets-list">
            @foreach ($tweets as $tweet)
                <li class="tweets-list-item tweet">
                    <div class="tweet-header">
                        <a href="{{ route('users.show', $tweet->user) }}">
                            <p class="tweet-header-name">{{ $tweet->user->name }}</p>
                        </a>

                        <p class="tweet-header-time">{{ $tweet->created_at->diffForHumans() }}</p>
                        
                        @if (is_object($tweet->test($tweet)))
                            <div class="tweet-header-heart tweet-header-heart-gray">
                                <form action="{{ route('likes.store', $tweet) }}" method="POST">
                                    @csrf
                                    <button type="submit">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                </form>
                            </div>
                        @else
                            <div class="tweet-header-heart">
                                <form action="{{ route('likes.destroy', $tweet) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                </form>
                            </div>
                        @endif

                        <p class="likes-count">({{ count($tweet->likes) }})</p>
                        
                        @if ($tweet->user->id === Auth::user()->id)
                            <div class="tweet-header-delete">
                                <form action="{{ route('tweets.destroy', $tweet) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        @endif

                        

                    </div>
                    <div class="tweet-body">
                        <div>
                            <p class="tweet-body-text">{{ $tweet->text }}</p>
                            @if ($tweet->file)
                                <p>
                                    <a href="{{ $tweet->file }}" target="_blank">
                                        <img src="{{ $tweet->file }}"  width="200">
                                    </a>
                                </p>
                            @endif
                        </div>

                    </div>
                </li>
            @endforeach
        </ul>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form action="{{ route('tweets.store') }}" method="POST" class="form" id="form" enctype="multipart/form-data">
            @csrf
            <div class="input-text">
                <input type="text" name="text" placeholder="say something..">
            </div>
            <div class="input-file">
                <label for="file">
                    <i class="fas fa-camera-retro"></i>
                </label>
                <input type="file" name="file" id="file" hidden>
            </div>
            
        </form>

    </div>
@endsection