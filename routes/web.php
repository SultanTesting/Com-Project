<?php

use App\Http\Controllers\Backend\Admin\AdminController;
use App\Http\Controllers\Backend\Admin\StripeController;
use App\Http\Controllers\Frontend\CheckOutController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\FlashSaleController;
use App\Http\Controllers\Frontend\FrontendProductController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\UserAddressController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\Frontend\UserOrdersController;
use App\Http\Controllers\Frontend\UserProfileController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Psy\VersionUpdater\Checker;

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

/** Cart Routes */
Route::post('add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');
Route::get('cart', [CartController::class, 'cartDetails'])->name('cart-details');
Route::get('cart/count', [CartController::class, 'cartCounter'])->name('cart-counter');
Route::get('cart/mini-cart', [CartController::class, 'miniCart'])->name('mini-cart');
Route::post('cart/update-qty', [CartController::class, 'updateQty'])->name('cart.update-qty');
Route::get('cart/delete/{rowid}', [CartController::class, 'clearItem'])->name('cart-delete');
Route::delete('cart/clearAll', [CartController::class, 'clearAll'])->name('cart-clear-all');
Route::get('mini-cart/subTotal', [CartController::class, 'miniCartSubTotal'])->name('mini-cart.sub-total');
Route::get('cart/coupon', [CartController::class, 'cartCoupon'])->name('cart-coupon');
Route::get('cart/coupon-calc', [CartController::class, 'couponCalc'])->name('cart.coupon-calc');

/** User Routes */
Route::prefix('user')->as('user.')
->group(function () {
    Route::get('dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('profile', [UserProfileController::class, 'index'])->name('profile');
    Route::put('profile', [UserProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('profile', [UserProfileController::class, 'updatePassword'])->name('profile.password');
    Route::resource('address', UserAddressController::class);

    /** Orders Routes */
    Route::get('order', [UserOrdersController::class, 'index'])->name('order.index');
    Route::get('order/{id}', [UserOrdersController::class, 'show'])->name('order.show');
    
    /** CheckOut Routes */
    Route::get('checkout', [CheckOutController::class, 'index'])->name('checkout');
    Route::post('checkout/submit', [CheckOutController::class, 'checkoutSubmit'])->name('checkout.submit');

    /** Payment Routes */
    Route::get('payment', [PaymentController::class, 'index'])->name('payment');
    Route::get('payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');

    /** Paypal Routes */
    Route::get('paypal/payment', [PaymentController::class, 'payWithPaypal'])->name('paypal.pay');
    Route::get('paypal/success', [PaymentController::class, 'paypalSuccess'])->name('paypal.success');
    Route::get('paypal/cancel', [PaymentController::class, 'paypalCancel'])->name('paypal.cancel');

    /** Stripe Routes */
    Route::post('stripe/payment', [PaymentController::class, 'payWithStripe'])->name('stripe.pay');

    /** Paymob Routes */
    Route::get('/payments/verify/{data}',[PaymentController::class,'payment_verify'])->name('verify-payment');

    Route::get('paymob/payment', [PaymentController::class, 'payWithPaymob'])->name('paymob.pay');
    Route::get('/callback', [PaymentController::class, 'callback'])->name('callback');


});

