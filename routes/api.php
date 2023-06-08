<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ExportController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\CuisineController;
use App\Http\Controllers\Api\FavouriteController;
use App\Http\Controllers\Api\PostController;
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
Route::post('update/{id}', [UserController::class, 'update']);

Route::get('view-cuisine', [CuisineController::class, 'index']);
Route::get('view-all-cuisine', [CuisineController::class, 'indexAll']);
Route::get('view-category-cuisine/{id}', [CuisineController::class, 'cuisineOfCate']);
Route::get('view-category', [CuisineController::class, 'categoryAll']);
Route::post('create-cuisine', [CuisineController::class, 'store']);
Route::get('show-cuisine-favourite/{id}', [CuisineController::class, 'show']);
Route::get('show-cuisine-user/{id}', [CuisineController::class, 'showUser']);

Route::post('update-cuisine/{id}', [CuisineController::class, 'update']);
Route::delete('delete-cuisine/{id}', [CuisineController::class, 'destroy']);

Route::get('search-cuisine/{key}', [CuisineController::class, 'search']);

Route::get('show-user-cuisine/{id}', [UserController::class, 'show']);

Route::post('store-comment', [CommentController::class, 'store']);
Route::get('view-comment/{id}', [CommentController::class, 'index']);
Route::post('update-comment/{id}', [CommentController::class, 'update']);
Route::delete('delete-comment/{id}', [CommentController::class, 'destroy']);
Route::post('store-replay-comment', [CommentController::class, 'replayComment']);

Route::post('store-favourite', [FavouriteController::class, 'storeFavourite']);
Route::get('get-all-favourite/{id}', [FavouriteController::class, 'index']);
Route::get('get-favourite/{id}', [FavouriteController::class, 'show']);
Route::delete('delete-favourite/{id}', [FavouriteController::class, 'destroy']);

Route::get('view-banner', [BannerController::class, 'indexBanner']);

Route::post('create-post', [PostController::class, 'store']);
Route::get('view-all-post', [PostController::class, 'index']);
Route::get('view-post-user/{id}', [PostController::class, 'postOfUser']);

Route::post('update-post/{id}', [PostController::class, 'update']);
Route::delete('delete-post/{id}', [PostController::class, 'destroy']);

Route::get('view-comment-post/{id}', [CommentController::class, 'indexPost']);

Route::post('store-comment-post', [CommentController::class, 'storePost']);
Route::post('update-comment-reply/{id}', [CommentController::class, 'updateReply']);
Route::delete('delete-comment-reply/{id}', [CommentController::class, 'destroyReply']);

Route::get('cuisine-status/{id}', [CuisineController::class, 'approve']);
