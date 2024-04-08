<?php

use App\Http\Controllers\Backend\Admin\AdminController;
use App\Http\Controllers\Frontend\FlashSaleController;
use App\Http\Controllers\Frontend\FrontendProductController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\Frontend\UserProfileController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('admin/login', [AdminController::class, 'login'])->name('admin.login');

Route::get('flash-sale', FlashSaleController::class)->name('flash-sale');

Route::get('product/{slug}', FrontendProductController::class)->name('product-detail');

// Route::resource('user/dashboard', UserDashboardController::class, ['as' => 'user'])
// ->only(['index']);

// Route::post('user/profile', [UserProfileController::class, 'updatePassword'])->name('user.password');
// Route::resource('user/profile', UserProfileController::class, ['as' => 'user'])->only(['index', 'update']);

Route::prefix('user')->as('user.')
->group(function () {
    Route::get('dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('profile', [UserProfileController::class, 'index'])->name('profile');
    Route::put('profile', [UserProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('profile', [UserProfileController::class, 'updatePassword'])->name('profile.password');
});

