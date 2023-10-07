<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Backend\VendorProfileController;

// ! [ prefix && as ] methods predefined in RouteServiceProvider

Route::middleware(['auth', 'verified'])->group(function (){
    Route::get('dashboard', [VendorController::class, 'dashboard'])->name('dashboard');
    Route::get('profile',  [VendorProfileController::class, 'index'])->name('profile');
    Route::put('profile',  [VendorProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('profile', [VendorProfileController::class, 'updatePassword'])->name('profile.password');
});

