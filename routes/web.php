<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'AuthLogin']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('dashboard', function() {
    return view('welcome');
});

Route::group(['middleware' => 'admin'], function() {
    Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);


    //users list
    Route::get('admin/users/list', [UserController::class, 'list']);
    Route::get('admin/users/add', [UserController::class, 'add']);
    Route::post('admin/users/add', [UserController::class, 'insert']);
    Route::get('admin/users/edit/{id}', [UserController::class, 'edit']);
    Route::post('admin/users/edit/{id}', [UserController::class, 'update']);
    Route::get('admin/users/delete/{id}', [UserController::class, 'delete']);

});

Route::group(['middleware' => 'user'], function() {
    Route::get('user/dashboard', [DashboardController::class, 'dashboard']);

    //category
    Route::get('user/category/list', [CategoryController::class, 'list']);
    Route::get('user/category/show/{id}', [CategoryController::class, 'show']);
    Route::get('user/category/add', [CategoryController::class, 'add']);
    Route::post('user/category/add', [CategoryController::class, 'insert']);
    Route::get('user/category/edit/{id}', [CategoryController::class, 'edit']);
    Route::post('user/category/edit/{id}', [CategoryController::class, 'update']);
    Route::get('user/category/delete/{id}', [CategoryController::class, 'delete']);

    //product
    Route::get('/user/product/list', [ProductController::class, 'list']);
    Route::get('/user/product/add', [ProductController::class, 'add']);
    Route::post('/user/product/add', [ProductController::class, 'insert']);
    Route::get('/user/product/edit/{id}', [ProductController::class, 'edit']);
    Route::post('/user/product/edit/{id}', [ProductController::class, 'update']);
    Route::get('/user/product/delete/{id}', [ProductController::class, 'delete']);
    Route::get('user/product/show/{id}', [ProductController::class, 'show']);
});


