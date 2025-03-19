<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/products', function () {
    return view('products');
});

Route::get('/products/{id}', function ($id) {
    return view('product-detail', ['id' => $id]);
});

Route::get('/cart', function () {
    return view('cart');
});

Route::get('/checkout', function () {
    return view('checkout');
});
