<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\OrderAddressController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\OrderItemController;
use App\Http\Controllers\Api\CardController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\StoreController;
use App\Http\Controllers\Api\TagController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('/products', ProductController::class);
Route::apiResource('/categories', CategoryController::class);
Route::apiResource('/orders', OrderController::class);
Route::apiResource('/OrderAddresess', OrderAddressController::class);
Route::apiResource('/OrderItems', OrderItemController::class);
Route::apiResource('/cards', CardController::class);
Route::apiResource('/profiles', ProfileController::class);
Route::apiResource('/stores', StoreController::class);
Route::apiResource('/tags', TagController::class);
