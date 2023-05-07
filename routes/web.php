<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CuisineController;
use App\Http\Controllers\Admin\FoodController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin
Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/users/update/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

    Route::get('/cuisine', [CuisineController::class, 'index'])->name('cuisine.index');
    Route::get('/cuisine/create', [CuisineController::class, 'create'])->name('cuisine.create');
    Route::post('/cuisine/store', [CuisineController::class, 'store'])->name('cuisine.store');
    Route::get('/cuisine/edit/{id}', [CuisineController::class, 'edit'])->name('cuisine.edit');
    Route::post('/cuisine/update/{id}', [CuisineController::class, 'update'])->name('cuisine.update');
    Route::delete('/cuisine/{id}', [CuisineController::class, 'destroy'])->name('cuisine.destroy');
});
