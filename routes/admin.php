<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\variantItemController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\ProductGalleryController;
use App\Http\Controllers\Backend\VendorFrontEndController;
use App\Http\Controllers\Backend\ProductVariantsController;


Route::middleware(['web', 'role:admin', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath'])
    ->prefix('admin')
    ->as('admin.')
    ->group( function(){

        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // Route::get('profile', [ProfileController::class, 'index'])->name('profile');

        // Route::post('profile/update', [ProfileController::class, 'update'])->name('profile.update');

        Route::post('profile/update/pass', [ProfileController::class, 'updatePassword'])->name('password.update');
        Route::resource('profile', ProfileController::class)->only(['index', 'update']);

        // ? Slider Routes */

        Route::resource('slider', SliderController::class);

        // ? Categories Routes */

        Route::put('category-status', [CategoryController::class, 'changeStatus'])->name('category.change-status');
        Route::resource('category', CategoryController::class)->except('show');

        // ? Sub Categories Routes */

        Route::put('subcategory/status', [SubCategoryController::class, 'changeStatus'])->name('sub-category.change-status');
        Route::resource('sub-category', SubCategoryController::class)->except('show');

        // ? Child Categories Routes */

        Route::put('childcategory/status', [ChildCategoryController::class, 'changeStatus'])->name('child-category.change-status');
        Route::get('get-subcategories', [ChildCategoryController::class, 'getSubCategories'])->name('get-subCategories');
        Route::resource('child-category', ChildCategoryController::class)->except('show');

        // ? Brand Routes

        Route::put('brand-status', [BrandController::class, 'changeStatus'])->name('brand.change-status');
        Route::resource('brand', BrandController::class)->except('show');

        // ? Vendor FrontEnd Routes

        Route::resource('vendor-profile', VendorFrontEndController::class)->except('show');

        // ? Products Routes

        Route::get('products/get-subcategories', [ProductController::class, 'getSubCategories'])->name('product.get-subcategories');

        Route::get('products/get-childcategories', [ProductController::class, 'getChildCategories'])->name('product.get-childcategories');

        Route::put('products/status', [ProductController::class, 'changeStatus'])->name('products.change-status');

        Route::resource('products', ProductController::class)->except('show');

        // ? Products Variants

        Route::resource('product/gallery', ProductGalleryController::class)
        ->except(['show', 'create', 'edit', 'update'])
        ->names('product-gallery');

        Route::put('product/variants/status', [ProductVariantsController::class, 'changeStatus'])->name('product.variants.status');
        Route::resource('product/variants', ProductVariantsController::class)->except('show')
        ->names('product-variants');

        // ? Product Variant Item

        Route::put('products/variant/item/status', [variantItemController::class, 'changeStatus'])
        ->name('product.variant-item.change-status');

        Route::resource('products/variant/item', variantItemController::class)->except('show')
        ->names('product.variant-item');

    });









