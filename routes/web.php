<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\IPTVController;
use App\Http\Controllers\Customer\FundsController;
use App\Http\Controllers\Customer\ProductController;
use App\Http\Controllers\Customer\ServiceController;
use App\Http\Controllers\Customer\TestIPTVController;
use App\Http\Controllers\Customer\DashboardController;
use App\Http\Controllers\Customer\SocialLoginController;

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

Route::get('auth/{provider}/redirect', [SocialLoginController::class , 'redirect'])->name('auth.socialite.redirect');
Route::get('auth/{provider}/callback', [SocialLoginController::class , 'callback'])->name('auth.socialite.callback');

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
    Route::get('/edit-profile', [DashboardController::class, 'editProfile'])->name('edit.profile');
    Route::post('/edit-profile', [DashboardController::class, 'storeEditProfile'])->name('store.edit.profile');
    Route::get('/change-password', [DashboardController::class, 'changePassword'])->name('change.password');
    Route::post('/change-password', [DashboardController::class, 'storeChangePassword'])->name('store.change.password');
    Route::get('/shipping-address', [DashboardController::class, 'shippingAddress'])->name('shipping.address');
    Route::post('/shipping-address', [DashboardController::class, 'storeShippingAddress'])->name('store.shipping.address');
    Route::get('/help', [DashboardController::class, 'help'])->name('help');

    Route::prefix('test')->name('test.')->group(function () {
        Route::get('/', [TestIPTVController::class, 'index'])->name('index');
        Route::get('/get', [TestIPTVController::class, 'get'])->name('get');
        Route::get('/verify', [TestIPTVController::class, 'verify'])->name('verify');
        Route::post('/verify', [TestIPTVController::class, 'storeVerify'])->name('store.verify');
        Route::get('/resend', [TestIPTVController::class, 'resend'])->name('resend');
        Route::get('/otp', [TestIPTVController::class, 'otp'])->name('otp');
        Route::post('/otp', [TestIPTVController::class, 'storeOtp'])->name('store.otp');
        Route::get('/thank-you', [TestIPTVController::class, 'thankyou'])->name('thankyou');
    });

    Route::prefix('iptv')->name('iptv.')->group(function () {
        Route::get('/my-subscriptions', [IPTVController::class, 'mySubscription'])->name('my.subscription');
        Route::get('/services', [IPTVController::class, 'services'])->name('services');
        Route::get('/purchase/{id}', [IPTVController::class, 'purchase'])->name('purchase');
        Route::get('/thank-you', [IPTVController::class, 'thankyou'])->name('thankyou');
    });

    Route::prefix('popular-services')->name('services.')->group(function () {
        Route::get('/', [ServiceController::class, 'index'])->name('index');
        Route::get('/view/{id}', [ServiceController::class, 'view'])->name('view');
        Route::get('/my-services', [ServiceController::class, 'myService'])->name('my.service');
        Route::get('/purchase/{id}', [ServiceController::class, 'purchase'])->name('purchase');
        Route::get('/thank-you', [ServiceController::class, 'thankyou'])->name('thankyou');
        Route::post('/review/{id}', [ServiceController::class, 'review'])->name('review');
    });

    Route::prefix('popular-products')->name('products.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/view/{id}', [ProductController::class, 'view'])->name('view');
        Route::get('/my-products', [ProductController::class, 'myProduct'])->name('my.product');
        Route::get('/purchase/{id}', [ProductController::class, 'purchase'])->name('purchase');
        Route::get('/thank-you', [ProductController::class, 'thankyou'])->name('thankyou');
        Route::post('/review/{id}', [ProductController::class, 'review'])->name('review');
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
