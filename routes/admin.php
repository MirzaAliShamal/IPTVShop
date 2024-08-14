<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FundsCardController;
use App\Http\Controllers\Admin\BankAccountController;
use App\Http\Controllers\Admin\IPTVServiceController;
use App\Http\Controllers\Admin\PayPalAccountController;

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

Route::middleware('auth', 'admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::prefix('settings')->name('setting.')->controller(SettingsController::class)->group(function() {
        Route::get('/', 'index')->name('index');
        Route::post('/save', 'save')->name('save');
    });

    Route::prefix('iptv-services')->name('iptv.service.')->controller(IPTVServiceController::class)->group(function() {
        Route::get('/', 'index')->name('index');
        Route::get('/fetch', 'fetch')->name('fetch');
        Route::get('/add', 'add')->name('add');
        Route::get('/edit/{iptvService}', 'edit')->name('edit');
        Route::post('/save', 'save')->name('save');
        Route::put('/update/{iptvService}', 'update')->name('update');
        Route::get('/delete/{iptvService}', 'delete')->name('delete');
    });

    Route::prefix('services')->name('service.')->controller(ServiceController::class)->group(function() {
        Route::get('/', 'index')->name('index');
        Route::get('/fetch', 'fetch')->name('fetch');
        Route::get('/add', 'add')->name('add');
        Route::get('/edit/{service}', 'edit')->name('edit');
        Route::post('/save', 'save')->name('save');
        Route::put('/update/{service}', 'update')->name('update');
        Route::get('/delete/{service}', 'delete')->name('delete');
    });

    Route::prefix('products')->name('product.')->controller(ProductController::class)->group(function() {
        Route::get('/', 'index')->name('index');
        Route::get('/fetch', 'fetch')->name('fetch');
        Route::get('/add', 'add')->name('add');
        Route::get('/edit/{product}', 'edit')->name('edit');
        Route::post('/save', 'save')->name('save');
        Route::put('/update/{product}', 'update')->name('update');
        Route::get('/delete/{product}', 'delete')->name('delete');
    });

    Route::prefix('funds-cards')->name('funds.card.')->controller(FundsCardController::class)->group(function() {
        Route::get('/giftcard', 'giftcard')->name('giftcard');
        Route::get('/paypal', 'paypal')->name('paypal');
        Route::get('/visa', 'visa')->name('visa');
        Route::get('/fetch', 'fetch')->name('fetch');
        Route::get('/add', 'add')->name('add');
        Route::get('/edit/{fundsCard}', 'edit')->name('edit');
        Route::post('/save', 'save')->name('save');
        Route::put('/update/{fundsCard}', 'update')->name('update');
        Route::get('/delete/{fundsCard}', 'delete')->name('delete');
    });

    Route::prefix('bank-accounts')->name('bank.account.')->controller(BankAccountController::class)->group(function() {
        Route::get('/', 'index')->name('index');
        Route::get('/fetch', 'fetch')->name('fetch');
        Route::get('/add', 'add')->name('add');
        Route::get('/edit/{bank}', 'edit')->name('edit');
        Route::post('/save', 'save')->name('save');
        Route::put('/update/{bank}', 'update')->name('update');
        Route::get('/delete/{bank}', 'delete')->name('delete');
    });

    Route::prefix('paypal-accounts')->name('paypal.account.')->controller(PayPalAccountController::class)->group(function() {
        Route::get('/', 'index')->name('index');
        Route::get('/fetch', 'fetch')->name('fetch');
        Route::get('/add', 'add')->name('add');
        Route::get('/edit/{paypal}', 'edit')->name('edit');
        Route::post('/save', 'save')->name('save');
        Route::put('/update/{paypal}', 'update')->name('update');
        Route::get('/delete/{paypal}', 'delete')->name('delete');
    });
});
