<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('api')->group(function () {
    // Route::resource('customers', CustomerController::class);
    Route::get('/customers', [CustomerController::class, 'getCustomers']);
    Route::post('/customer', [CustomerController::class, 'createCustomer']);
    Route::post('/customer/edit', [CustomerController::class, 'editCustomer']);
    Route::delete('/customer/{id}', [CustomerController::class, 'deleteCustomer']);
});
