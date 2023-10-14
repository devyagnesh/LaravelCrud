<?php

use App\Http\Controllers\Api\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ResetPasswordController;
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

Route::middleware('guest')->group(function(){
    Route::get('/', [AuthController::class,'showSignup'])->name('showSignup');
    Route::get('/login',[AuthController::class,'showLogin'])->name('login');
    Route::post('/login',[AuthController::class,'postLogin'])->name('postLogin');
    Route::post('/signup',[AuthController::class,'Signup'])->name('Signup');
});


Route::middleware('auth')->group(function(){
    Route::get('/dashboard',[DashboardController::class,'showDashboard'])->name('showDashboard');
    Route::get('/category/add',[CategoryController::class,'viewCategoryPage'])->name('viewCategoryPage');
    Route::post('/category/add',[CategoryController::class,'createCategory'])->name('createCategory');
    Route::get('/product/add',[ProductController::class,'showAddProductPage'])->name('showAddProductPage');
    Route::post('/product/add',[ProductController::class,'addProduct'])->name('addProduct');
    Route::get('/product/edit/{id}',[ProductController::class,'editProduct'])->name('editProduct');
    Route::post('/product/edit/{id}',[ProductController::class,'postEditProduct'])->name('postEditProduct');
    Route::get('/product/delete/{id}',[ProductController::class,'deleteProduct'])->name('deleteProduct');
    Route::get('/password/reset',[ResetPasswordController::class,'showResetPassword'])->name('resetPassword');
    Route::post('/password/reset', [ResetPasswordController::class,'reset'])->name('reset');
});
