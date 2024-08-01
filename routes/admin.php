<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\IPTVServiceController;

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
});
