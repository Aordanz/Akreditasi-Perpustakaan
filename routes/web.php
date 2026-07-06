<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/akreditasi', function () {
    return view('akreditasi');
});
