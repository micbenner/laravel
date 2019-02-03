<?php

if (app()->environment('local')) {
    Route::get('login/{id}', \App\Http\Controllers\Auth\LocalLoginHandler::class);
}

Route::post('auth/login', \App\Http\Controllers\Auth\LoginHandler::class);
Route::post('auth/register', \App\Http\Controllers\Auth\RegisterHandler::class);

Route::get('{route}', function () {
    return view('vue');
})->where('route', '(.*)');
