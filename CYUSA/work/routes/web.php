<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/logout', function () {
    return view('logout');
});

Route::get('/Register', function () {
    return view('Register');
});