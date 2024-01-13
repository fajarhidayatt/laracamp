<?php

use Illuminate\Support\Facades\Route;

/// admin controller
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\CheckoutController as AdminCheckoutController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\DiscountController;

/// user controller
use App\Http\Controllers\User\CheckoutController as UserCheckoutController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;

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

/// home page
Route::get('/', function () {
    return view('pages.home');
})->name('home');

/// user
Route::middleware(['auth', 'ensureUserRole:user'])->group(function () {
    Route::get('/user', [UserDashboardController::class, 'index'])->name('user.dashboard');

    /// checkout
    Route::get('/checkout/success', [UserCheckoutController::class, 'success'])->name('checkout.success');
    Route::get('/checkout/{camp:slug}', [UserCheckoutController::class, 'create'])->name('checkout');
    Route::post('/checkout/{camp}', [UserCheckoutController::class, 'store'])->name('checkout.proccess');
});

/// admin
Route::middleware(['auth', 'ensureUserRole:admin'])->group(function () {
    Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    /// checkout menu
    Route::get('/admin/checkout', [AdminCheckoutController::class, 'index'])->name('admin.checkout.index');

    /// discount menu
    Route::resource('/admin/discount', DiscountController::class, ['as' => 'admin']);

    /// update profile
    Route::get('/admin/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::patch('/admin/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
    Route::delete('/admin/profile', [ProfileController::class, 'destroy'])->name('admin.profile.destroy');
});

/**
 * callback midtrans
 * tambahkan url callback di bawah ini ke dashboard midtrans
 * note: hanya bisa dijalankan ketika sudah di hosting, tidak bisa ketika masih development
 */
Route::get('payment/success', [UserCheckoutController::class, 'midtransCallback']);
Route::post('payment/success', [UserCheckoutController::class, 'midtransCallback']);

require __DIR__ . '/auth.php';
