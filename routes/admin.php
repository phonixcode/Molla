<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\ShippingController;
use App\Http\Controllers\Auth\Admin\LoginController;
use Illuminate\Support\Facades\Artisan;

Route::group(['prefix' => 'admin', 'middleware' => ['guest:admin', 'preventBackHistory']], function () {
    Route::get('login', [LoginController::class, 'form'])->name('admin.form');
    Route::post('login', [LoginController::class, 'login'])->name('admin.login');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth:admin', 'preventBackHistory']], function () {

    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin');

    //Banner Section
    Route::resource('banner', BannerController::class);
    Route::post('banner-status', [BannerController::class, 'bannerStatus'])->name('banner.status');

    //Band Section
    Route::resource('brand', BrandController::class);
    Route::post('brand-status', [BrandController::class, 'brandStatus'])->name('brand.status');

    //Category Section
    Route::resource('category', CategoryController::class);
    Route::post('category/{id}/child', [CategoryController::class, 'getChildByParentID']);
    Route::post('category-status', [CategoryController::class, 'categoryStatus'])->name('category.status');

    //Product Section
    Route::resource('product', ProductController::class);
    Route::post('product-status', [ProductController::class, 'productStatus'])->name('product.status');
    Route::get('product-attribute/{product}', [ProductController::class, 'attribute'])->name('product.attribute');
    Route::post('product-attribute/{product}', [ProductController::class, 'storeProductAttribute'])->name('product.attribute.store');
    Route::delete('product-attribute-destroy/{product}', [ProductController::class, 'destroyProductAttribute'])->name('product.attribute.destroy');

    //User Section
    Route::resource('user', UserController::class);
    Route::post('user-status', [UserController::class, 'userStatus'])->name('user.status');

    // Coupons Section
    Route::resource('coupon', CouponController::class);
    Route::post('coupon-status', [CouponController::class, 'couponStatus'])->name('coupon.status');

    // shipping Section
    Route::resource('shipping', ShippingController::class);
    Route::post('shipping-status', [shippingController::class, 'shippingStatus'])->name('shipping.status');

    // Order Section
    Route::resource('order', OrderController::class);
    Route::post('order-status', [OrderController::class, 'orderStatus'])->name('order.status');

    // Settings Section
    Route::get('settings', [SettingsController::class, 'settings'])->name('settings');
    Route::put('settings', [SettingsController::class, 'updateSettings'])->name('settings.update');
    Route::get('clear-cache', [SettingsController::class, 'optimize'])->name('settings.optimize');
    Route::get('system-info', [SettingsController::class, 'systemInfo'])->name('settings.system.info');
    Route::put('mail-config', [SettingsController::class, 'mailConfig'])->name('settings.mail.config');
    Route::put('db-config', [SettingsController::class, 'databaseConfig'])->name('settings.db.config');

    Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout');
});

Route::group(['prefix' => 'filemanager', 'middleware' => ['web', 'auth:admin']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
