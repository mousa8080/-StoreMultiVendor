<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashpoardController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;



Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('products', [ProductsController::class, 'index'])->name('products');
Route::get('product/{product:slug}', [ProductsController::class, 'show'])->name('product.show');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__ . '/auth.php';
require __DIR__ . '/dashpoard.php';
