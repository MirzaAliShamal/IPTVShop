<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FundsCardController;
use App\Http\Controllers\Admin\BankAccountController;
use App\Http\Controllers\Admin\IPTVServiceController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\ProductOrderController;
use App\Http\Controllers\Admin\PayPalAccountController;
use App\Http\Controllers\Admin\PayPalMultipleController;
use App\Http\Controllers\Admin\TestIptvAccountController;
use App\Http\Controllers\Admin\IPTVSubscriptionController;
use App\Http\Controllers\Admin\ServiceSubscriptionController;

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

    Route::prefix('profile')->name('profile.')->controller(DashboardController::class)->group(function () {
        Route::get('/', 'profile')->name('index');
        Route::post('/basic', 'basic')->name('basic');
        Route::post('/password', 'password')->name('password');
    });

    Route::prefix('settings')->name('setting.')->controller(SettingsController::class)->group(function() {
        Route::get('/payment-methods', 'paymentMethods')->name('payment.method');
        Route::post('/save', 'save')->name('save');
    });

    Route::prefix('users')->name('user.')->controller(UserController::class)->group(function() {
        Route::get('/', 'index')->name('index');
        Route::get('/fetch', 'fetch')->name('fetch');
        Route::get('/delete/{user}', 'delete')->name('delete');
        Route::get('/adjust/{user}', 'adjust')->name('adjust');
        Route::put('/adjust/{user}', 'adjustBalance')->name('adjust.balance');
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

    Route::prefix('test-iptv-accounts')->name('test.iptv.')->controller(TestIptvAccountController::class)->group(function() {
        Route::get('/', 'index')->name('index');
        Route::get('/fetch', 'fetch')->name('fetch');
        Route::get('/add', 'add')->name('add');
        Route::get('/edit/{testIptvAccount}', 'edit')->name('edit');
        Route::post('/save', 'save')->name('save');
        Route::put('/update/{testIptvAccount}', 'update')->name('update');
        Route::get('/delete/{testIptvAccount}', 'delete')->name('delete');
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
        Route::get('/paypal', 'paypal')->name('paypal');
        Route::get('/wire-transder', 'wireTransfer')->name('wire.transfer');
        Route::get('/visa', 'visa')->name('visa');

        Route::get('/fetch', 'fetch')->name('fetch');
        Route::get('/add', 'add')->name('add');
        Route::get('/edit/{fundsCard}', 'edit')->name('edit');
        Route::post('/save', 'save')->name('save');
        Route::put('/update/{fundsCard}', 'update')->name('update');
        Route::get('/delete/{fundsCard}', 'delete')->name('delete');
    });

    Route::prefix('paypal-multiples')->name('paypal.multiple.')->controller(PayPalMultipleController::class)->group(function() {
        Route::get('/index', 'index')->name('index');
        Route::get('/fetch', 'fetch')->name('fetch');
        Route::get('/add', 'add')->name('add');
        Route::get('/edit/{paypal}', 'edit')->name('edit');
        Route::post('/save', 'save')->name('save');
        Route::get('/view/{paypal}', 'view')->name('view');
        Route::put('/update/{paypal}', 'update')->name('update');
        Route::get('/delete/{paypal}', 'delete')->name('delete');
    });

    Route::prefix('transactions')->name('transaction.')->controller(TransactionController::class)->group(function() {
        Route::get('/paypal', 'paypal')->name('paypal');
        Route::get('/wire-transfer', 'wireTransfer')->name('wire.transfer');
        Route::get('/visa', 'visa')->name('visa');

        Route::get('/fetch', 'fetch')->name('fetch');
        Route::get('/add', 'add')->name('add');
        Route::get('/edit/{transaction}', 'edit')->name('edit');
        Route::put('/update/{transaction}', 'update')->name('update');
        Route::get('/delete/{transaction}', 'delete')->name('delete');
    });

    Route::prefix('iptv-subscriptions')->name('iptv.subscription.')->controller(IPTVSubscriptionController::class)->group(function() {
        Route::get('/', 'index')->name('index');
        Route::get('/fetch', 'fetch')->name('fetch');
        Route::get('/edit/{subscription}', 'edit')->name('edit');
        Route::put('/update/{subscription}', 'update')->name('update');
        Route::get('/delete/{subscription}', 'delete')->name('delete');
        Route::get('/suspend/{subscription}', 'suspend')->name('suspend');
    });

    Route::prefix('services-subscriptions')->name('service.subscription.')->controller(ServiceSubscriptionController::class)->group(function() {
        Route::get('/', 'index')->name('index');
        Route::get('/fetch', 'fetch')->name('fetch');
        Route::get('/edit/{subscription}', 'edit')->name('edit');
        Route::put('/update/{subscription}', 'update')->name('update');
        Route::get('/delete/{subscription}', 'delete')->name('delete');
        Route::get('/suspend/{subscription}', 'suspend')->name('suspend');
    });

    Route::prefix('products-orders')->name('products.order.')->controller(ProductOrderController::class)->group(function() {
        Route::get('/', 'index')->name('index');
        Route::get('/fetch', 'fetch')->name('fetch');
        Route::get('/edit/{productOrder}', 'edit')->name('edit');
        Route::put('/update/{productOrder}', 'update')->name('update');
        Route::get('/delete/{productOrder}', 'delete')->name('delete');
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
