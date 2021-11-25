<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('pages.dashboard.index');
})->name('home-dashboard');

Route::get('/products', function () {
    return view('pages.product.index');
})->name('products');
