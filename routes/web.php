<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashpoardController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductsController;
use App\Http\Controllers\Front\CardController;
use App\Http\Controllers\Front\CheckOutController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Front\Auth\TowFactorAuthenticationController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\SocialController;

Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('products', [ProductsController::class, 'index'])->name('products');
    Route::get('product/{product:slug}', [ProductsController::class, 'show'])->name('product.show');
    Route::resource('card', CardController::class);

    Route::get('checkout', [CheckOutController::class, 'create'])->name('checkout');
    Route::post('checkout', [CheckOutController::class, 'store']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/auth/user/2fa', [TowFactorAuthenticationController::class, 'showTwoFactorAuthenticationForm'])->name('front.auth.2fa');
    Route::post('/currency/convert', [\App\Http\Controllers\Front\CurrencyConverterController::class, 'convert'])->name('currency.convert');
});

Route::get('auth/{provider}/redirect', [SocialLoginController::class, 'redirectToProvider'])->name('auth.social.redirect');
Route::get('auth/{provider}/callback', [SocialLoginController::class, 'handleProviderCallback'])->name('auth.social.callback');
Route::get('auth/{provider}/user', [SocialController::class, 'index'])->name('auth.user.social');

// require __DIR__ . '/auth.php';
require __DIR__ . '/dashpoard.php';
