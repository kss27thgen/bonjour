<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'auth'], function () {
    Route::resource('/tweets', 'TweetsController');

    Route::post('/tweets/{tweet}/likes', 'LikesController@store')->name('likes.store');
    Route::delete('tweets/{tweet}/likes', 'LikesController@destroy')->name('likes.destroy');


    Route::get('/users/{user}/myroom', 'UsersController@myroom')->name('users.myroom');
    Route::get('/users/{user}', 'UsersController@show')->name('users.show');
    Route::get('/users/{user}/follow', 'UsersController@follow')->name('users.follow');
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
