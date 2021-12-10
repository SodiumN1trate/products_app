<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductSearchController;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});



// Users
Route::middleware('auth:api')->get('/user', [UserController::class, 'user']);
Route::post('/login', [UserController::class, 'login']);
Route::middleware('auth:api')->post('/logout', [UserController::class, 'logout']);


// Products
Route::apiResource('/products', ProductController::class)->middleware('auth:api');


// Product search
Route::middleware('auth:api')->get("products/search/{title}", [ProductSearchController::class, 'search']);
