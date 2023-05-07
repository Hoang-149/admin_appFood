<?php

use App\Http\Controllers\Api\CuisineController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/register', [UserController::class, 'register']);

Route::post('login', [UserController::class, 'login']);

Route::get('view-cuisine', [CuisineController::class, 'index']);
Route::get('view-category', [CuisineController::class, 'category']);
Route::post('create-cuisine', [CuisineController::class, 'store']);