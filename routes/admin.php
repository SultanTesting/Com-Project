<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Admin\AdminController;
use App\Http\Controllers\Backend\Admin\BrandController;
use App\Http\Controllers\Backend\Admin\SliderController;
use App\Http\Controllers\Backend\Admin\ProductController;
use App\Http\Controllers\Backend\Admin\ProfileController;
use App\Http\Controllers\Backend\Admin\CategoryController;
use App\Http\Controllers\Backend\Admin\SubCategoryController;
use App\Http\Controllers\Backend\Admin\variantItemController;
use App\Http\Controllers\Backend\Admin\ChildCategoryController;
use App\Http\Controllers\Backend\Admin\CouponController;
use App\Http\Controllers\Backend\Admin\OrderController;
use App\Http\Controllers\Backend\Admin\ProductGalleryController;
use App\Http\Controllers\Backend\Admin\VendorFrontEndController;
use App\Http\Controllers\Backend\Admin\ProductVariantsController;
use App\Http\Controllers\Backend\Admin\SellersProductsController;
use App\Http\Controllers\Backend\Admin\SettingsController;
use App\Http\Controllers\Backend\Admin\ShippingCenterController;
use App\Http\Controllers\Backend\Admin\PaymentSettingsController;
use App\Http\Controllers\Backend\Admin\PaymobController;
use App\Http\Controllers\Backend\Admin\PaypalController;
use App\Http\Controllers\Backend\Admin\StripeController;
use App\Http\Controllers\Backend\Admin\StripeSettings;
use App\Http\Controllers\Backend\Admin\StripeSettingsController;
use App\Http\Controllers\Backend\FlashSaleController;
use App\Http\Controllers\Backend\Admin\TransactionsController;
use App\Http\Controllers\Backend\HomePageSettingsController;

Route::middleware(['auth', 'verified' ,'role:admin', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath'])
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

        // ? Sellers & Pending Products Routes

        Route::get('pending/products', [SellersProductsController::class, 'pendingProducts'])
        ->name('pending-products');
        Route::put('change-approved', [SellersProductsController::class, 'changeApproved'])
        ->name('change-approved');
        Route::resource('seller/products', SellersProductsController::class)
        ->names('seller.products');

        // ? Flash Sale Routes

        Route::delete('flash-clear-all', [FlashSaleController::class, 'clearAll'])->name('flash-clear-all');
        Route::PUT('flash/status', [FlashSaleController::class, 'changeStatus'])->name('flash-status');
        Route::resource('flash-sale', FlashSaleController::class)->only(['index', 'create', 'store', 'destroy']);

        // ? Coupons Routes

        Route::put('coupon/status', [CouponController::class, 'changeStatus'])->name('coupon-status');
        Route::resource('coupon', CouponController::class);

        // ? Order Routes

        Route::get('order/status', [OrderController::class, 'orderStatus'])->name('order-status');
        Route::get('payment/status', [OrderController::class, 'paymentStatus'])->name('payment-status');
        Route::resource('order', OrderController::class);

        // ? Transactions Routes

        Route::get('transactions', TransactionsController::class)->name('transactions');

        // ? General Settings Routes

        Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
        Route::put('general-settings-update', [SettingsController::class, 'generalSettingsUpdate'])->name('general-settings.update');

        // ? Home Page Settings

        Route::get('home-settings', [HomePageSettingsController::class, 'index'])->name('home-settings');
        Route::put('top-categories', [HomePageSettingsController::class, 'topCategories'])->name('top-categories');

        // ? Shipping Center Routes

        Route::put('shipping/status', [ShippingCenterController::class, 'changeStatus'])->name('shipping-status');
        Route::resource('shipping', ShippingCenterController::class);

        // ? Payment Settings Routes
        Route::get('payment-settings', PaymentSettingsController::class)->name('payment-settings');
        Route::post('paypal', PaypalController::class)->name('paypal-settings');
        Route::post('stripe', StripeController::class)->name('stripe-settings');
        Route::post('paymob', PaymobController::class)->name('paymob-settings');



    });









