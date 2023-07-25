<?php

use App\Http\Controllers\api\AdminsController;
use App\Http\Controllers\api\TransactionsController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\ProductsController;
use App\Http\Controllers\api\StatisticsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('admins', AdminsController::class);
Route::apiResource('transactions', TransactionsController::class);

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::get('statistics', [StatisticsController::class, 'statistics']);

Route::get('product', [ProductsController::class, 'index']);
