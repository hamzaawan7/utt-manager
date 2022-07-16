<?php

use App\Http\Controllers\AvailabilityController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\LateAvailabilityController;
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
Route::post('/user/save', [UserController::class, 'save'])->name('user-save');
Route::get('/user/find/{id}', [UserController::class, 'find']);
Route::get('/user/delete/{id}', [UserController::class, 'delete']);

//Property Category Route
Route::get('/property/category/list', [PropertyCategoryController::class, 'index'])->name('propert-category-list');
Route::post('/category/save', [PropertyCategoryController::class, 'save'])->name('category-save');
Route::get('/category/get', [PropertyCategoryController::class, 'getCategory']);
Route::get('/category/find/{id}', [PropertyCategoryController::class, 'find']);
Route::get('/category/delete/{id}', [PropertyCategoryController::class, 'delete']);

Route::prefix('property')->group(function () {
    Route::get('/list', [PropertyController::class, 'index'])->name('property-list');
    Route::get('/add', [PropertyController::class, 'addProperty'])->name('add-property');
    Route::get('/price/get/{id}', [PropertyController::class, 'getCategoryPrice']);
    Route::post('/save', [PropertyController::class, 'save'])->name('property-save');
    Route::get('/find/{id}', [PropertyController::class, 'find']);
    Route::get('/delete/{id}', [PropertyController::class, 'delete']);
    Route::get('/image/delete/{id}', [PropertyController::class, 'deleteImage'])->name('image-delete');

    Route::get('/feature/list', [FeatureController::class, 'index'])->name('feature-list');
    Route::get('/feature/get', [FeatureController::class, 'getFeatures']);
    Route::post('/feature/save', [FeatureController::class, 'save'])->name('feature-save');
    Route::get('/feature/find/{id}', [FeatureController::class, 'find']);
    Route::get('/feature/delete/{id}', [FeatureController::class, 'delete']);
});

//Owner Route
Route::prefix('owner')->group(function () {
    Route::get('/list', [OwnerController::class, 'index'])->name('owner-list');
    Route::get('/get', [OwnerController::class, 'getOwner']);
    Route::post('/save', [OwnerController::class, 'save'])->name('owner-save');
    Route::get('/find/{id}', [OwnerController::class, 'find']);
    Route::get('/delete/{id}', [OwnerController::class, 'delete']);

});

//Customer Route
Route::prefix('customer')->group(function () {
    Route::get('/list', [CustomerController::class, 'index'])->name('customer-list');
    Route::get('/get', [CustomerController::class, 'getCustomer']);
    Route::post('/save', [CustomerController::class, 'save'])->name('customer-save');
    Route::get('/find/{id}', [CustomerController::class, 'find']);
    Route::get('/delete/{id}', [CustomerController::class, 'delete']);
});

Route::prefix('review')->group(function () {
    Route::get('/list', [ReviewController::class, 'index'])->name('review-list');
    Route::get('/get', [ReviewController::class, 'getReview']);
    Route::post('/save', [ReviewController::class, 'save'])->name('review-save');
    Route::get('/find/{id}', [ReviewController::class, 'find']);
    Route::get('/delete/{id}', [ReviewController::class, 'delete']);
});

//Price Route
Route::prefix('price')->group(function () {
    Route::get('/list', [PriceController::class, 'index'])->name('price-list');
    Route::get('/get', [PriceController::class, 'getPrice']);
    Route::post('/save', [PriceController::class, 'save'])->name('price-save');
    Route::get('/find/{id}', [PriceController::class, 'find']);
    Route::get('/delete/{id}', [PriceController::class, 'delete']);

    Route::get('/category/list', [PriceCategoryController::class, 'index'])->name('price-category-list');
    Route::get('/category/get', [PriceCategoryController::class, 'getPriceCategory']);
    Route::post('/category/save', [PriceCategoryController::class, 'save'])->name('price-category-save');
    Route::get('/category/find/{id}', [PriceCategoryController::class, 'find']);
    Route::get('/category/delete/{id}', [PriceCategoryController::class, 'delete']);

    Route::get('/season/list', [PriceSeasonController::class, 'index'])->name('price-season-list');
    Route::get('/season/get', [PriceSeasonController::class, 'getSeason']);
    Route::post('/season/save', [PriceSeasonController::class, 'save'])->name('price-season-save');
    Route::get('/season/find/{id}', [PriceSeasonController::class, 'find']);
    Route::get('/season/delete/{id}', [PriceSeasonController::class, 'delete']);
});

//Discount Route
Route::prefix('discount')->group(function () {
    Route::get('/list', [DiscountController::class, 'index'])->name('discount-list');
    Route::get('/get', [DiscountController::class, 'getDiscount']);
    Route::post('/save', [DiscountController::class, 'save'])->name('discount-save');
    Route::get('/find/{id}', [DiscountController::class, 'find']);
    Route::get('/delete/{id}', [DiscountController::class, 'delete']);

});

//All Availability Route
Route::prefix('availability')->group(function () {
    Route::get('/list', [AvailabilityController::class, 'index'])->name('availability-list');
    Route::get('/get', [AvailabilityController::class, 'getDiscount']);
    Route::get('/individual/calendar/{id}', [AvailabilityController::class, 'individualCalendar']);
    Route::post('/save', [AvailabilityController::class, 'save'])->name('availability-save');
    Route::get('/find/{id}', [AvailabilityController::class, 'find']);
    Route::get('/delete/{id}', [AvailabilityController::class, 'delete']);

});

//Booking Route
Route::prefix('booking')->group(function () {
    Route::get('/list', [BookingController::class, 'index'])->name('booking-list');
    Route::post('/save', [BookingController::class, 'save'])->name('booking-save');
    Route::post('/owner/save', [BookingController::class, 'ownerSave'])->name('booking-owner-save');
    Route::get('/find/{id}', [BookingController::class, 'find']);
    Route::get('/delete/{id}', [BookingController::class, 'delete']);

});

//Late Availability Route
Route::prefix('late')->group(function () {
    Route::get('/availability/list', [LateAvailabilityController::class, 'index'])->name('late-availability-list');
    Route::get('/availability/get', [LateAvailabilityController::class, 'getLateAvailability']);
    Route::post('/availability/save', [LateAvailabilityController::class, 'save'])->name('late-availability-save');
    Route::get('/availability/find/{id}', [LateAvailabilityController::class, 'find']);
    Route::get('/availability/delete/{id}', [LateAvailabilityController::class, 'delete']);

});

//Late Availability Route
Route::prefix('cleaning')->group(function () {
    Route::get('/rota/list', [BookingController::class, 'cleaningRotaList'])->name('cleaningRotaList');
    Route::get('/rota/get/{id}', [BookingController::class, 'getCleaningRota']);

});

Route::get("/owner/mail", function(){
    return view("emails.owner_mail_template");
});