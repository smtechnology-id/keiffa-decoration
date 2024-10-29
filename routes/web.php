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
});

Route::group(['middleware' => ['authCheck:user']], function () {
    Route::get('/user/index', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/catalog', [UserController::class, 'catalog'])->name('user.catalog');
    Route::get('/user/portfolio', [UserController::class, 'portfolio'])->name('user.portfolio');
    Route::get('/user/cart', [UserController::class, 'cart'])->name('user.cart');
    Route::get('/user/order', [UserController::class, 'order'])->name('user.order');
});

