<?php

use App\Http\Controllers\CartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductsController;

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

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [LoginController::class, 'login']);
Route::resource('products', ProductsController::class);
Route::get('user_cart',[CartController::class,'index']);
Route::post('add_to_cart', [CartController::class, 'addToCart']);
Route::post('decrement_cart', [CartController::class, 'decrement']);
Route::post('increment_cart', [CartController::class, 'increment']);
Route::post('delete_from_cart', [CartController::class, 'deleteCartItem']);
