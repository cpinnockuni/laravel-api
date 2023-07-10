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


//Ensure the endpoints are not case senstive so can query

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1', 'case_sensitive' => false], function () {
    Route::apiResource('customers', CustomerController::class);
    Route::apiResource('Customers', CustomerController::class);
    Route::apiResource('CUSTOMERS', CustomerController::class);
    Route::apiResource('invoices', InvoiceController::class);
    Route::apiResource('INVOICES', InvoiceController::class);
    Route::apiResource('Invoices', InvoiceController::class);



    
});
