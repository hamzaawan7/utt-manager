<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PriceCategoryController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\PriceSeasonController;
use App\Http\Controllers\PropertyCategoryController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;

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

Route::get('/', [DashboardController::class, 'login']);

Auth::routes();

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/user/list', [UserController::class, 'list'])->name('user-list');
Route::post('/user/save', [UserController::class, 'saveUserRole'])->name('user-save');
Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user-edit');
Route::get('/user/delete/{id}', [UserController::class, 'delete'])->name('user-delete');

//Property Category Route
Route::get('/property/category/list', [PropertyCategoryController::class, 'index'])->name('propert-category-list');
Route::post('/category/save', [PropertyCategoryController::class, 'save'])->name('category-save');
Route::get('/category/get', [PropertyCategoryController::class, 'getCategory'])->name('category-get');
Route::get('/category/find/{id}', [PropertyCategoryController::class, 'find'])->name('category-find');
Route::get('/category/delete/{id}', [PropertyCategoryController::class, 'delete'])->name('category-delete');

Route::prefix('property')->group(function () {
    Route::get('/list', [PropertyController::class, 'index'])->name('property-list');
    Route::get('/get', [PropertyController::class, 'getProperty'])->name('property-get');
    Route::post('/save', [PropertyController::class, 'save'])->name('property-save');
    Route::get('/find/{id}', [PropertyController::class, 'find'])->name('property-find');
    Route::get('/delete/{id}', [PropertyController::class, 'delete'])->name('property-delete');
    Route::get('/image/delete/{id}', [PropertyController::class, 'deleteImage'])->name('image-delete');

    Route::get('/feature/list', [FeatureController::class, 'index'])->name('feature-list');
    Route::get('/feature/get', [FeatureController::class, 'getFeatures'])->name('feature-get');
    Route::post('/feature/save', [FeatureController::class, 'save'])->name('feature-save');
    Route::get('/feature/find/{id}', [FeatureController::class, 'edit'])->name('feature-find');
    Route::get('/feature/delete/{id}', [FeatureController::class, 'delete'])->name('feature-delete');
});

//Owner Route
Route::prefix('owner')->group(function () {
    Route::get('/list', [OwnerController::class, 'index'])->name('owner-list');
    Route::get('/get', [OwnerController::class, 'getOwner'])->name('owner-get');
    Route::post('/save', [OwnerController::class, 'save'])->name('owner-save');
    Route::get('/find/{id}', [OwnerController::class, 'find'])->name('owner-edit');
    Route::get('/delete/{id}', [OwnerController::class, 'delete'])->name('owner-delete');

});

//Customer Route
Route::prefix('customer')->group(function () {
    Route::get('/list', [CustomerController::class, 'index'])->name('customer-list');
    Route::get('/get', [CustomerController::class, 'getCustomer'])->name('customer-get');
    Route::post('/save', [CustomerController::class, 'save'])->name('customer-save');
    Route::get('/find/{id}', [CustomerController::class, 'find'])->name('customer-find');
    Route::get('/delete/{id}', [CustomerController::class, 'delete'])->name('customer-delete');
});

Route::prefix('review')->group(function () {
    Route::get('/list', [ReviewController::class, 'index'])->name('review-list');
    Route::get('/get', [ReviewController::class, 'getReview'])->name('review-get');
    Route::post('/save', [ReviewController::class, 'save'])->name('review-save');
    Route::get('/edit/{id}', [ReviewController::class, 'edit'])->name('review-edit');
    Route::get('/delete/{id}', [ReviewController::class, 'delete'])->name('review-delete');
});

//Price Route
Route::prefix('price')->group(function () {
    Route::get('/list', [PriceController::class, 'index'])->name('price-list');
    Route::post('/save', [PriceController::class, 'save'])->name('price-save');
    Route::get('/edit/{id}', [PriceController::class, 'edit'])->name('price-edit');
    Route::get('/delete/{id}', [PriceController::class, 'delete'])->name('price-delete');

    Route::get('/category/list', [PriceCategoryController::class, 'index'])->name('price-category-list');
    Route::get('/category/create', [PriceCategoryController::class, 'create'])->name('price-category-create');
    Route::post('/category/save', [PriceCategoryController::class, 'save'])->name('price-category-save');
    Route::get('/category/edit/{id}', [PriceCategoryController::class, 'edit'])->name('price-category-edit');
    Route::post('/category/update', [PriceCategoryController::class, 'update'])->name('price-category-update');
    Route::get('/category/delete/{id}', [PriceCategoryController::class, 'delete'])->name('price-category-delete');

    Route::get('/season/list', [PriceSeasonController::class, 'index'])->name('price-season-list');
    Route::get('/season/create', [PriceSeasonController::class, 'create'])->name('price-season-create');
    Route::post('/season/save', [PriceSeasonController::class, 'save'])->name('price-season-save');
    Route::get('/season/edit/{id}', [PriceSeasonController::class, 'edit'])->name('price-season-edit');
    Route::post('/season/update', [PriceSeasonController::class, 'update'])->name('price-season-update');
    Route::get('/season/delete/{id}', [PriceSeasonController::class, 'delete'])->name('price-season-delete');
});
