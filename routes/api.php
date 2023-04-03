<?php

use App\Http\Controllers\GetPaymentOptionsApiController;
use App\Http\Controllers\SaleApiController;
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

Route::get('/payment-options', [GetPaymentOptionsApiController::class, 'get']);

Route::post('/sale', [SaleApiController::class, 'sale']);
