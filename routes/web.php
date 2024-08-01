<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\IPTVController;
use App\Http\Controllers\Customer\ProductController;
use App\Http\Controllers\Customer\ServiceController;
use App\Http\Controllers\Customer\DashboardController;

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

require __DIR__.'/auth.php';

Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard.index');
        } else {
            return redirect()->route('dashboard.index');
        }
    } else {
        return redirect()->route('login');
    }
});

Route::get('/verification', function() {
    return view('auth.verification');
});

Route::middleware('auth', 'customer', 'otp.verify')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('/iptv/test', [IPTVController::class, 'test'])->name('iptv.test');
    Route::get('/iptv/services', [IPTVController::class, 'services'])->name('iptv.services');

    Route::get('/popular-services', [ServiceController::class, 'index'])->name('services.index');

    Route::get('/popular-products', [ProductController::class, 'index'])->name('products.index');
});
