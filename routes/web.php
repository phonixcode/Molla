<?php

use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Test\TestController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\IndexController;
use App\Http\Controllers\Web\CheckoutController;
use App\Http\Controllers\Web\WishlistController;
use App\Http\Controllers\Web\Auth\LoginController;
use App\Http\Controllers\Web\Auth\RegisterController;
use App\Http\Controllers\Web\User\UserController;
use App\Http\Controllers\Web\ProductController;
use App\Http\Controllers\Web\ProductReviewController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__ . './admin.php';


Route::get('/', [IndexController::class, 'home'])->name('home');
Route::get('about-us', [IndexController::class, 'about'])->name('about');
Route::get('contact-us', [IndexController::class, 'contact'])->name('contact');
Route::get('faq', [IndexController::class, 'faq'])->name('faq');

Route::get('cart', [CartController::class, 'cart'])->name('cart');
// Route::post('/add-to-cart',[CartController::class , 'singleAddToCart'])->name('single.add.to.cart');
Route::post('cart/store', [CartController::class, 'cartStore'])->name('cart.store');
Route::post('cart/delete', [CartController::class, 'cartDelete'])->name('cart.delete');
Route::post('cart/update', [CartController::class, 'cartUpdate'])->name('cart.update');
Route::post('coupon/add', [CartController::class, 'couponAdd'])->name('coupon.add');

Route::get('wishlist', [WishlistController::class, 'wishlist'])->name('wishlist');
Route::post('wishlist/store', [WishlistController::class, 'wishlistStore'])->name('wishlist.store');
Route::post('wishlist/move-cart', [WishlistController::class, 'wishlistMoveToCart'])->name('wishlist.move.cart');
Route::post('wishlist/delete', [WishlistController::class, 'wishlistDelete'])->name('wishlist.delete');

Route::get('products', [ProductController::class, 'products'])->name('products');
Route::get('product-lists', [ProductController::class, 'productLists'])->name('product.list');
Route::post('product-filter', [ProductController::class, 'productFilter'])->name('product.filter');
Route::get('product-category/{slug}', [ProductController::class, 'productCategory'])->name('product.category');
Route::get('product-details/{slug}', [ProductController::class, 'productDetails'])->name('product.details');
Route::get('auto-search', [ProductController::class, 'autoSearch'])->name('auto.search');
Route::get('search', [ProductController::class, 'search'])->name('search');
Route::post('product-review/{slug}', [ProductReviewController::class, 'productReview'])->name('product.review');

Route::get('checkout-one', [CheckoutController::class, 'checkoutOne'])->name('checkout.one')->middleware('user');
Route::post('checkout-one', [CheckoutController::class, 'checkoutOneStore'])->name('checkout.one.store');
Route::post('checkout-two', [CheckoutController::class, 'checkoutTwoStore'])->name('checkout.two.store');
Route::post('checkout-three', [CheckoutController::class, 'checkoutThreeStore'])->name('checkout.three.store');
Route::get('checkout', [CheckoutController::class, 'checkoutSubmit'])->name('checkout.submit');
Route::get('complete-checkout/{order}', [CheckoutController::class, 'complete'])->name('complete');

Auth::routes(['register' => false]);

Route::group(['prefix' => 'user', 'middleware' => ['guest:web', 'preventBackHistory']], function () {
    Route::get('login', [LoginController::class, 'userLogin'])->name('user.auth.login');
    Route::post('login', [LoginController::class, 'loginSubmit'])->name('login.submit');
    Route::get('register', [RegisterController::class, 'userRegister'])->name('user.auth.register');
    Route::post('register', [RegisterController::class, 'RegisterSubmit'])->name('register.submit');
});

Route::group(['prefix' => 'user', 'middleware' => ['auth:web', 'preventBackHistory']], function () {
    Route::get('dashboard', [UserController::class, 'userDashboard'])->name('user.dashboard');
    Route::get('orders', [UserController::class, 'userOder'])->name('user.order');
    Route::get('addresses', [UserController::class, 'userAddress'])->name('user.address');
    Route::get('account-details', [UserController::class, 'userAccountDetail'])->name('user.acct.detail');
    Route::post('billing/address/{uuid}', [UserController::class, 'billingAddress'])->name('billing.address');
    Route::post('shipping/address/{uuid}', [UserController::class, 'shippingAddress'])->name('shipping.address');
    Route::post('update/account/{uuid}', [UserController::class, 'updateAccount'])->name('update.account');
    Route::get('logout', [LoginController::class, 'userLogout'])->name('user.auth.logout');
});


// Route::get('welcome', [TestController::class, 'test'])->name('test.welcome');
// Route::post('welcome', [TestController::class, 'store'])->name('test.store');
