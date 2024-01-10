<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/login', function () {
    return view('pages.login');
})->name('login');

Route::get('/checkout', function () {
    return view('pages.checkout');
})->name('checkout');

Route::get('/checkout/success', function () {
    return view('pages.checkout-success');
})->name('checkout.success');

Route::get('/dashboard/user', function () {
    return view('pages.user.dashboard');
})->name('user');
