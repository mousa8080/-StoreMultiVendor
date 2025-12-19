<?php

use App\Http\Controllers\DashPoard\ProductController;
use App\Http\Controllers\Dashpoard\CategoriesController;
use App\Http\Controllers\Dashpoard\DashpoardController;
use App\Http\Controllers\Dashpoard\profileContoller;
use App\Http\Middleware\CheckUserType;
use App\Http\Middleware\UpdateUserActiveAt;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashpoard\RolesController;




Route::group([
  'middleware' => ['auth:admin,web'],
  'as' => 'dashpoard.',
  'prefix' => 'admin/dashpoard',


], function () {
  Route::get('/', [DashpoardController::class, 'index'])->name('dashboard');


  Route::get('/profile/edit', [profileContoller::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [profileContoller::class, 'update'])->name('profile.update');



  // Custom routes must be BEFORE resource routes to avoid conflicts
  Route::get('/categories/trashed', [CategoriesController::class, 'trashed'])->name('categories.trashed');
  Route::put('/categories/{category}/restore', [CategoriesController::class, 'restore'])->name('categories.restore');
  Route::delete('/categories/{category}/force-delete', [CategoriesController::class, 'forceDelete'])->name('categories.forceDelete');


  Route::resources([
    '/roles' => RolesController::class,
    '/categories' => CategoriesController::class,
    '/products' => ProductController::class,
    '/admins' => \App\Http\Controllers\Dashpoard\AdminsController::class,
    '/users' => \App\Http\Controllers\UsersController::class
  ]);
});
