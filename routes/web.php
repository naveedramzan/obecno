<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsersController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CmsController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\AppointmentsController;

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

Route::get('/', [CmsController::class, 'index']);
Route::get('/about-us', [CmsController::class, 'about']);
Route::get('/product-features', [CmsController::class, 'features']);

Route::get('/login', [UsersController::class, 'index'])->name('login');
Route::post('/login', [UsersController::class, 'login']);
Route::get('/sign-up', [UsersController::class, 'signUp'])->name('sign-up');
Route::post('/sign-up', [UsersController::class, 'signUpPosted']);

Route::get('/forgot-password', [UsersController::class, 'forgotPassword']);
Route::post('/forgot-password', [UsersController::class, 'resetPassword']);
Route::get('/dashboard', [UsersController::class, 'dashboard'])->middleware('auth');
Route::get('/logout', [UsersController::class, 'logout'])->middleware('auth');
Route::get('/change-password', [UsersController::class, 'password'])->middleware('auth');
Route::post('/change-password', [UsersController::class, 'updatePassword'])->middleware('auth');

// Route::get('/by-category-{category}', [ServicesController::class, 'getServices']);
// Route::get('/by-service-{service}', [SessionsController::class, 'getSessions']);
// Route::post('/book-appointment', [AppointmentsController::class, 'book']);

//admin routes
Route::get('/admin-list-{table}/{id}', [AdminController::class, 'adminList'])->middleware('auth');
Route::get('/admin-list-{table}', [AdminController::class, 'adminList'])->middleware('auth');
Route::get('/admin-edit-{table}/{id}', [AdminController::class, 'adminEdit'])->middleware('auth');
Route::post('/admin-edit-{table}/{id}', [AdminController::class, 'adminUpdate'])->middleware('auth');
Route::get('/admin-delete-{table}/{id}', [AdminController::class, 'adminDelete'])->middleware('auth');
Route::get('/admin-add-{table}', [AdminController::class, 'adminAdd'])->middleware('auth');
Route::get('/admin-add-{table}/{id}', [AdminController::class, 'adminAdd'])->middleware('auth');
Route::post('/admin-add-{table}', [AdminController::class, 'adminSave'])->middleware('auth');
Route::post('/admin-add-{table}/{id}', [AdminController::class, 'adminSave'])->middleware('auth');

//company routes
Route::get('/{slug}', [CmsController::class, 'aboutCompany']);

Route::domain('{category}.' . env('APP_URL'))->group(function () {
    Route::get('/', [CmsController::class, 'index']);
    Route::get('/{slug}', [CmsController::class, 'index']);
    Route::get('/{slug}/by-service-{service}', [SessionsController::class, 'getSessions']);
});