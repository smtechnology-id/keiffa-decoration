<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/loginPost', [AuthController::class, 'loginPost'])->name('loginPost');

// Register
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/registerPost', [AuthController::class, 'registerPost'])->name('registerPost');

// Logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::group(['middleware' => ['authCheck:admin']], function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Package
    Route::get('/admin/package', [AdminController::class, 'package'])->name('admin.package');
    Route::get('/admin/package/create', [AdminController::class, 'packageCreate'])->name('admin.package.create');
    Route::post('/admin/package/createPost', [AdminController::class, 'packageCreatePost'])->name('admin.package.createPost');
    Route::get('/admin/package/edit/{slug}', [AdminController::class, 'packageEdit'])->name('admin.package.edit');
    Route::post('/admin/package/update', [AdminController::class, 'packageUpdatePost'])->name('admin.package.updatePost');
    Route::get('/admin/package/delete/{slug}', [AdminController::class, 'packageDelete'])->name('admin.package.delete');


    // Additional
    Route::get('/admin/additional', [AdminController::class, 'additional'])->name('admin.additional');
    Route::get('/admin/additional/create', [AdminController::class, 'additionalCreate'])->name('admin.additional.create');
    Route::post('/admin/additional/createPost', [AdminController::class, 'additionalCreatePost'])->name('admin.additional.createPost');
    Route::get('/admin/additional/edit/{slug}', [AdminController::class, 'additionalEdit'])->name('admin.additional.edit');
    Route::post('/admin/additional/update', [AdminController::class, 'additionalUpdatePost'])->name('admin.additional.updatePost');
    Route::get('/admin/additional/delete/{slug}', [AdminController::class, 'additionalDelete'])->name('admin.additional.delete');


    // Review
    Route::get('/admin/review', [AdminController::class, 'review'])->name('admin.review');

    // Order
    Route::get('/admin/order', [AdminController::class, 'order'])->name('admin.order');
    Route::get('/admin/order/detail/{code_order}', [AdminController::class, 'orderDetail'])->name('admin.order.detail');
    Route::post('/admin/confirm-payment', [AdminController::class, 'confirmPayment'])->name('admin.confirm-payment');
    Route::post('/admin/reject-payment', [AdminController::class, 'rejectPayment'])->name('admin.reject-payment');

    // Portfolio
    Route::get('/admin/portfolio', [AdminController::class, 'portfolio'])->name('admin.portfolio');
    Route::get('/admin/portfolio/create', [AdminController::class, 'portfolioCreate'])->name('admin.portfolio.create');
    Route::post('/admin/portfolio/createPost', [AdminController::class, 'portfolioCreatePost'])->name('admin.portfolio.createPost');
    Route::get('/admin/portfolio/edit/{id}', [AdminController::class, 'portfolioEdit'])->name('admin.portfolio.edit');
    Route::post('/admin/portfolio/update', [AdminController::class, 'portfolioUpdatePost'])->name('admin.portfolio.updatePost');
    Route::get('/admin/portfolio/delete/{id}', [AdminController::class, 'portfolioDelete'])->name('admin.portfolio.delete');

    // Review
    Route::get('/admin/review/approve/{id}', [AdminController::class, 'reviewApprove'])->name('admin.review.approve');
    Route::get('/admin/review/reject/{id}', [AdminController::class, 'reviewReject'])->name('admin.review.reject');

    // User
    Route::get('/admin/user', [AdminController::class, 'user'])->name('admin.user');
    Route::post('/admin/user/update', [AdminController::class, 'userUpdate'])->name('admin.user.update');


});

Route::group(['middleware' => ['authCheck:user']], function () {
    Route::get('/user/index', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/catalog', [UserController::class, 'catalog'])->name('user.catalog');
    Route::get('/user/portfolio', [UserController::class, 'portfolio'])->name('user.portfolio');
    Route::get('/user/cart', [UserController::class, 'cart'])->name('user.cart');
    Route::get('/user/order', [UserController::class, 'order'])->name('user.order');
    Route::get('/user/review', [UserController::class, 'review'])->name('user.review');
    Route::get('/user/additional', [UserController::class, 'additional'])->name('user.additional');

    // Cart
    Route::get('/user/cart/add/{slug}', [UserController::class, 'cartAdd'])->name('user.cart.add');
    Route::get('/user/cart/addQuantity/{slug}', [UserController::class, 'cartAddQuantity'])->name('user.cart.addQuantity');
    Route::get('/user/cart/subQuantity/{slug}', [UserController::class, 'cartSubQuantity'])->name('user.cart.subQuantity');

    // Checkout
    Route::post('/user/checkout', [UserController::class, 'checkout'])->name('user.checkout');

    // Payment
    Route::get('/user/payment/{code_order}', [UserController::class, 'payment'])->name('user.payment');
    Route::post('/user/payment/down', [UserController::class, 'paymentDown'])->name('user.payment.down');
    Route::post('/user/payment/remaining', [UserController::class, 'paymentRemaining'])->name('user.payment.remaining');
    Route::post('/user/payment/remaining/update', [UserController::class, 'paymentRemainingUpdate'])->name('user.payment.remaining.update');
    Route::post('/user/payment/down/update', [UserController::class, 'paymentDownUpdate'])->name('user.payment.down.update');

    // Order Detail
    Route::get('/user/order/detail/{code_order}', [UserController::class, 'orderDetail'])->name('user.order-detail');

    // Portfolio Detail
    Route::get('/user/portfolio/detail/{id}', [UserController::class, 'portfolioDetail'])->name('user.portfolio-detail');

    // Add Review
    Route::post('/user/add-review', [UserController::class, 'addReview'])->name('user.add-review');


});

