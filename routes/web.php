<?php

use App\Http\Controllers\ProfileController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/shop', \App\Http\Controllers\Shop\IndexController::class)->name('shop.index');

Route::get('/shop/create', \App\Http\Controllers\Shop\CreateController::class)->name('shop.create');

Route::post('/shop/store', \App\Http\Controllers\Shop\StoreController::class)->middleware('auth')->name('shop.store');

Route::get('/shop/detail/{shopId}', \App\Http\Controllers\Shop\DetailController::class)->name('shop.detail');

Route::get('/shop/update/{shopId}', \App\Http\Controllers\Shop\Update\ShowController::class)->middleware('auth')->name('shop.update.show')->where('shopId', '[0-9]+');

Route::put('/shop/update/{shopId}', \App\Http\Controllers\Shop\Update\PutController::class)->name('shop.update.put')->where('shopId', '[0-9]+');

Route::delete('/shop/delete/{shopId}', \App\Http\Controllers\Shop\DeleteController::class)->middleware('auth')->name('shop.delete');

require __DIR__.'/auth.php';
