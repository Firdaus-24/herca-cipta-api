<?php

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


Route::apiResource(name: 'marketing', controller: \App\Http\Controllers\api\MarketingsController::class);
Route::apiResource(name: 'penjualan', controller: \App\Http\Controllers\api\PenjualansController::class);
Route::apiResource(name: 'customer', controller: \App\Http\Controllers\api\CustomersController::class);
Route::apiResource(name: 'payment', controller: \App\Http\Controllers\api\PaymentController::class);
