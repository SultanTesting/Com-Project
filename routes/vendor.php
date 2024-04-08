<?php

use App\Http\Controllers\Backend\Vendor\ProductVariantItemController;
use App\Http\Controllers\Backend\Vendor\ProductVariantsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Vendor\VendorController;
use App\Http\Controllers\Backend\Vendor\VendorProductController;
use App\Http\Controllers\Backend\Vendor\VendorProductGalleryController;
use App\Http\Controllers\Backend\Vendor\VendorProfileController;
use App\Http\Controllers\Backend\Vendor\VendorShopController;

// ! [ prefix && as ] methods predefined in RouteServiceProvider

Route::prefix('vendor')
->as('vendor.')
->group(function (){
    Route::get('dashboard', [VendorController::class, 'dashboard'])->name('dashboard');
    Route::get('profile',  [VendorProfileController::class, 'index'])->name('profile');
    Route::put('profile',  [VendorProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('profile', [VendorProfileController::class, 'updatePassword'])->name('profile.password');

    /** Vendor Shop Profile Routes */
    Route::resource('shop-profile', VendorShopController::class);

    /** Vendor Product Routes */
    Route::get('subCategories', [VendorProductController::class, 'getSubCategories'])->name('product.subCategories');
    Route::get('childCategories', [VendorProductController::class, 'getChildCategories'])->name('product.childCategories');
    Route::put('product/changeStatus', [VendorProductController::class, 'changeStatus'])->name('product.status');
    Route::resource('products', VendorProductController::class)->except('show');

    /** Vendor Product Gallery */
    Route::resource('product/gallery', VendorProductGalleryController::class)
        ->except(['show', 'create', 'edit', 'update'])
        ->names('product-gallery');

    /** Vendor Product Variants Routes */
    Route::put('variants-status', [ProductVariantsController::class, 'changeStatus'])->name('variant-status');
    Route::resource('product/variants', ProductVariantsController::class)->except('show');

    /** Product Variants Item Routes  */
    Route::put('item-status', [ProductVariantItemController::class, 'changeStatus'])->name('item-status');
    Route::resource('product/variants/item', ProductVariantItemController::class);
});

