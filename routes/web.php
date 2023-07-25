<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

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

Route::view('/', 'client.clientside');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login-process', [LoginController::class, 'login_process'])->name('login-process');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/register-process', [LoginController::class, 'register_process'])->name('register-process');

Route::get('/register', [LoginController::class, 'register'])->name('register');

Route::group(['prefix' => 'admin', 'middleware' => ['auth'], 'as' => 'admin.'], function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('dashboard-admin');
    Route::get('/product', [ProductController::class, 'dashboard'])->name('dashboard-product');
    Route::get('/transaction', [TransactionController::class, 'dashboard'])->name('dashboard-transaction');
    Route::get('/reporting', [TransactionController::class, 'reporting'])->name('reporting');

    Route::get('/create-admin', [AdminController::class, 'create'])->name('create-admin');
    Route::post('/store-admin', [AdminController::class, 'store'])->name('store-admin');
    Route::get('/edit-admin/{id}', [AdminController::class, 'edit'])->name('edit-admin');
    Route::put('/update-admin/{id}', [AdminController::class, 'update'])->name('update-admin');
    Route::delete('/delete-admin/{id}', [AdminController::class, 'delete'])->name('delete-admin');

    Route::get('/create-product', [ProductController::class, 'create'])->name('create-product');
    Route::post('/store-product', [ProductController::class, 'store'])->name('store-product');
    Route::get('/edit-product/{id}', [ProductController::class, 'edit'])->name('edit-product');
    Route::put('/update-product/{id}', [ProductController::class, 'update'])->name('update-product');
    Route::delete('/delete-product/{id}', [ProductController::class, 'delete'])->name('delete-product');

    Route::get('/create-transaction', [TransactionController::class, 'create'])->name('create-transaction');
    Route::post('/store-transaction', [TransactionController::class, 'store'])->name('store-transaction');
    Route::get('/edit-transaction/{id}', [TransactionController::class, 'edit'])->name('edit-transaction');
    Route::put('/update-transaction/{id}', [TransactionController::class, 'update'])->name('update-transaction');
    Route::delete('/delete-transaction/{id}', [TransactionController::class, 'delete'])->name('delete-transaction');
});
