<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Route::get('/product/find-by-status', [ProductController::class, 'findByStatus'])->name('product.by.status');
Route::get('/product/test-version', [ProductController::class, 'testVersion'])->name('product.test.version');
Route::post('/product/create-product', [ProductController::class, 'storeProduct'])->name('product.store');
