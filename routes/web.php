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

Route::get('/', [App\Http\Controllers\DashboardController::class, 'login']);

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
Route::get('/user/list', [App\Http\Controllers\UserController::class, 'list'])->name('user-list');
Route::post('/user/role/save', [App\Http\Controllers\UserController::class, 'saveUserRole'])->name('user-role-save');
Route::get('/user/role/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('user-role-edit');
Route::get('/user/role/delete/{id}', [App\Http\Controllers\UserController::class, 'delete'])->name('user-role-delete');

//Property Category Route
Route::get('/property/category/list', [App\Http\Controllers\PropertyCategoryController::class, 'index'])->name('propert-category-list');
Route::post('/category/save', [App\Http\Controllers\PropertyCategoryController::class, 'save'])->name('category-save');
Route::get('/category/edit/{id}', [App\Http\Controllers\PropertyCategoryController::class, 'edit'])->name('category-edit');
Route::get('/category/delete/{id}', [App\Http\Controllers\PropertyCategoryController::class, 'delete'])->name('category-delete');

Route::prefix('property')->group(function () {


    Route::get('/feature/list', [App\Http\Controllers\FeatureController::class, 'index'])->name('feature-list');
    Route::post('/feature/save', [App\Http\Controllers\FeatureController::class, 'save'])->name('feature-save');
    Route::get('/feature/edit/{id}', [App\Http\Controllers\FeatureController::class, 'edit'])->name('feature-edit');
    Route::get('/feature/delete/{id}', [App\Http\Controllers\FeatureController::class, 'delete'])->name('feature-delete');

});
//Price Route

Route::prefix('price')->group(function () {

    Route::get('/list', [App\Http\Controllers\PriceController::class, 'index'])->name('price-list');
    Route::get('/create', [App\Http\Controllers\PriceController::class, 'create'])->name('price-create');
    Route::post('/save', [App\Http\Controllers\PriceController::class, 'save'])->name('price-save');
    Route::get('/edit/{id}', [App\Http\Controllers\PriceController::class, 'edit'])->name('price-edit');
    Route::post('/update', [App\Http\Controllers\PriceController::class, 'update'])->name('price-update');
    Route::get('/delete/{id}', [App\Http\Controllers\PriceController::class, 'delete'])->name('price-delete');

    Route::get('/category/list', [App\Http\Controllers\PriceCategoryController::class, 'index'])->name('price-category-list');
    Route::get('/category/create', [App\Http\Controllers\PriceCategoryController::class, 'create'])->name('price-category-create');
    Route::post('/category/save', [App\Http\Controllers\PriceCategoryController::class, 'save'])->name('price-category-save');
    Route::get('/category/edit/{id}', [App\Http\Controllers\PriceCategoryController::class, 'edit'])->name('price-category-edit');
    Route::post('/category/update', [App\Http\Controllers\PriceCategoryController::class, 'update'])->name('price-category-update');
    Route::get('/category/delete/{id}', [App\Http\Controllers\PriceCategoryController::class, 'delete'])->name('price-category-delete');

    Route::get('/season/list', [App\Http\Controllers\PriceSeasonController::class, 'index'])->name('price-season-list');
    Route::get('/season/create', [App\Http\Controllers\PriceSeasonController::class, 'create'])->name('price-season-create');
    Route::post('/season/save', [App\Http\Controllers\PriceSeasonController::class, 'save'])->name('price-season-save');
    Route::get('/season/edit/{id}', [App\Http\Controllers\PriceSeasonController::class, 'edit'])->name('price-season-edit');
    Route::post('/season/update', [App\Http\Controllers\PriceSeasonController::class, 'update'])->name('price-season-update');
    Route::get('/season/delete/{id}', [App\Http\Controllers\PriceSeasonController::class, 'delete'])->name('price-season-delete');

});



