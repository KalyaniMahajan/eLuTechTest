<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Authentication Routes...
Route::post('register', 'Auth\AuthController@register');
Route::post('login', 'Auth\AuthController@login');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('logout', 'Auth\AuthController@logout')->name('logout'); 
Route::middleware('auth:api')->group(function () {
    Route::resource('/post', 'PostController');
});

