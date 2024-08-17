<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\IPTVController;
use App\Http\Controllers\Customer\FundsController;
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
    Route::get('/shipping-address', [DashboardController::class, 'shippingAddress'])->name('shipping.address');
    Route::post('/shipping-address', [DashboardController::class, 'storeShippingAddress'])->name('store.shipping.address');
    Route::get('/help', [DashboardController::class, 'help'])->name('help');

    Route::prefix('iptv')->name('iptv.')->group(function () {
        Route::get('/test', [IPTVController::class, 'test'])->name('test');
        Route::get('/get-test', [IPTVController::class, 'getTest'])->name('get.test');
        Route::get('/my-subscriptions', [IPTVController::class, 'mySubscription'])->name('my.subscription');
        Route::get('/services', [IPTVController::class, 'services'])->name('services');
        Route::get('/purchase/{id}', [IPTVController::class, 'purchase'])->name('purchase');
        Route::get('/thank-you', [IPTVController::class, 'thankyou'])->name('thankyou');
    });

    Route::prefix('popular-services')->name('services.')->group(function () {
        Route::get('/', [ServiceController::class, 'index'])->name('index');
        Route::get('/my-services', [ServiceController::class, 'myService'])->name('my.service');
        Route::get('/purchase/{id}', [ServiceController::class, 'purchase'])->name('purchase');
        Route::get('/thank-you', [ServiceController::class, 'thankyou'])->name('thankyou');
    });

    Route::prefix('popular-products')->name('products.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/my-products', [ProductController::class, 'myProduct'])->name('my.product');
        Route::get('/purchase/{id}', [ProductController::class, 'purchase'])->name('purchase');
        Route::get('/thank-you', [ProductController::class, 'thankyou'])->name('thankyou');
    });

    Route::prefix('funds')->name('funds.')->group(function () {
        Route::get('/index', [FundsController::class, 'index'])->name('index');
        Route::get('/paypal/{id}', [FundsController::class, 'paypal'])->name('paypal');
        Route::get('/visa/{id}', [FundsController::class, 'visa'])->name('visa');
        Route::post('/purchase/{id}', [FundsController::class, 'purchase'])->name('purchase');
        Route::get('/thank-you', [FundsController::class, 'thankyou'])->name('thankyou');
        Route::get('/insufficient-balance', [FundsController::class, 'insufficient'])->name('insufficient');
        Route::get('/redeem-giftcard', [FundsController::class, 'redeemGiftCard'])->name('redeem.giftcard');
        Route::post('/redeem-giftcard', [FundsController::class, 'storeRedeemGiftCard'])->name('store.redeem.giftcard');
    });
});
