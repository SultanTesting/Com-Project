<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SliderController;

// ! [ prefix && as ] methods predefined in RouteServiceProvider

Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

// Route::get('profile', [ProfileController::class, 'index'])->name('profile');

// Route::post('profile/update', [ProfileController::class, 'update'])->name('profile.update');

Route::post('profile/update/pass', [ProfileController::class, 'updatePassword'])->name('password.update');
Route::resource('profile', ProfileController::class)->only(['index', 'update']);

// ? Slider Routes */

Route::resource('slider', SliderController::class);

// ? Categories Routes */

Route::resource('category', CategoryController::class);





