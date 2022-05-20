<?php

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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/',[App\Http\Controllers\DashboardController::class,'login']);

Auth::routes();

Route::get('/dashboard',[App\Http\Controllers\DashboardController::class,'index'])->name('dashboard');
Route::get('/user/list',[App\Http\Controllers\UserController::class,'list'])->name('user-list');
Route::post('/user/role/save',[App\Http\Controllers\UserController::class,'saveUserRole'])->name('user-role-save');
Route::get('/user/role/edit/{id}',[App\Http\Controllers\UserController::class,'edit'])->name('user-role-edit');
Route::get('/user/role/delete/{id}',[App\Http\Controllers\UserController::class,'delete'])->name('user-role-delete');

//Property Category Route
Route::get('/property/category/list',[App\Http\Controllers\PropertyCategoryController::class,'index'])->name('propert-category-list');
Route::post('/category/save',[App\Http\Controllers\PropertyCategoryController::class,'save'])->name('category-save');
Route::get('/category/edit/{id}',[App\Http\Controllers\PropertyCategoryController::class,'edit'])->name('category-edit');
Route::get('/category/delete/{id}',[App\Http\Controllers\PropertyCategoryController::class,'delete'])->name('category-delete');

