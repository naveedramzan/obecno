<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsersController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CmsController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\OfficeLocationController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CompanyController;

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

// Public Routes (No Authentication Required)
Route::get('/', [CmsController::class, 'index']);
Route::get('/about-us', [CmsController::class, 'about']);
Route::get('/product-features', [CmsController::class, 'features']);
Route::get('/testing', [CmsController::class, 'testing']);

// Authentication Routes (Public)
Route::get('/login', [UsersController::class, 'index'])->name('login');
Route::post('/login', [UsersController::class, 'login']);
Route::get('/sign-up', [UsersController::class, 'signUp'])->name('sign-up');
Route::post('/sign-up', [UsersController::class, 'signUpPosted']);
Route::get('/forgot-password', [UsersController::class, 'forgotPassword']);
Route::post('/forgot-password', [UsersController::class, 'resetPassword']);

// Protected Routes (Authentication Required)
Route::middleware('auth')->group(function () {
    // Dashboard Routes
    Route::get('/super-admin-dashboard', [UsersController::class, 'superAdminDashboard'])->name('super-admin-dashboard');
    Route::get('/dashboard', [UsersController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [UsersController::class, 'profile'])->name('profile');
    Route::post('/profile', [UsersController::class, 'updateProfile'])->name('profile.update');
    Route::post('/notifications/{id}/read', [UsersController::class, 'markNotificationAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [UsersController::class, 'markAllNotificationsAsRead'])->name('notifications.read-all');
    Route::get('/settings', [UsersController::class, 'settings'])->name('settings');
    Route::get('/calendar', [UsersController::class, 'calendar'])->name('calendar');
    
    // Company Routes - specific routes first to avoid conflicts
    Route::get('/companies-list', [CompanyController::class, 'index'])->name('companies.index');
    Route::get('/companies/create', [CompanyController::class, 'create'])->name('companies.create');
    Route::post('/companies/store', [CompanyController::class, 'store'])->name('companies.store');
    Route::get('/companies/switch/{id}', [UsersController::class, 'switchCompany'])->name('companies.switch');
    Route::get('/companies/{id}/edit', [CompanyController::class, 'edit'])->name('companies.edit');
    Route::put('/companies/{id}/update', [CompanyController::class, 'update'])->name('companies.update');

    Route::post('/settings', [UsersController::class, 'updateSettings'])->name('settings.update');
    Route::get('/payments', [UsersController::class, 'payments'])->name('payments');
    Route::get('/logout', [UsersController::class, 'logout'])->name('logout');
    Route::get('/change-password', [UsersController::class, 'password'])->name('change-password');
    Route::post('/change-password', [UsersController::class, 'updatePassword']);
    
    // Check-in/Check-out Routes
    Route::post('/check-in', [UsersController::class, 'checkIn'])->name('check-in');
    Route::post('/check-out', [UsersController::class, 'checkOut'])->name('check-out');
    
    // Employee Routes
    Route::get('/mark-attendance', [UsersController::class, 'markAttendance'])->name('mark-attendance');
    Route::get('/apply-leave', [UsersController::class, 'applyLeave'])->name('apply-leave');
    Route::post('/apply-leave', [UsersController::class, 'storeLeave'])->name('leave.store');
    
    // Leave Management Routes
    Route::post('/leaves/{id}/approve', [UsersController::class, 'approveLeave'])->name('leave.approve');
    Route::post('/leaves/{id}/reject', [UsersController::class, 'rejectLeave'])->name('leave.reject');
    
    // Attendance Management Routes
    Route::get('/employees/{id}/update-attendance', [UsersController::class, 'updateAttendance'])->name('update-attendance');
    Route::post('/employees/{id}/update-attendance', [UsersController::class, 'saveAttendance'])->name('attendance.save');

    // Office Locations Routes
    Route::get('/office-locations', [OfficeLocationController::class, 'index'])->name('office-locations.index');
    Route::get('/office-locations/create', [OfficeLocationController::class, 'create'])->name('office-locations.create');
    Route::post('/office-locations', [OfficeLocationController::class, 'store'])->name('office-locations.store');
    Route::get('/office-locations/{id}/edit', [OfficeLocationController::class, 'edit'])->name('office-locations.edit');
    Route::put('/office-locations/{id}', [OfficeLocationController::class, 'update'])->name('office-locations.update');
    Route::delete('/office-locations/{id}', [OfficeLocationController::class, 'destroy'])->name('office-locations.destroy');

    // Employees Routes
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
    Route::get('/employees/{id}', [EmployeeController::class, 'show'])->name('employees.show');
    Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
    Route::get('/employees/upload', [EmployeeController::class, 'upload'])->name('employees.upload');
    Route::post('/employees/upload', [EmployeeController::class, 'uploadProcess'])->name('employees.upload.process');
    Route::get('/employees/{id}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
    Route::put('/employees/{id}', [EmployeeController::class, 'update'])->name('employees.update');
    Route::delete('/employees/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy');

    // Admin Routes
    Route::get('/admin-list-{table}/{id}', [AdminController::class, 'adminList']);
    Route::get('/admin-list-{table}', [AdminController::class, 'adminList']);
    Route::get('/admin-edit-{table}/{id}', [AdminController::class, 'adminEdit']);
    Route::post('/admin-edit-{table}/{id}', [AdminController::class, 'adminUpdate']);
    Route::get('/admin-delete-{table}/{id}', [AdminController::class, 'adminDelete']);
    Route::get('/admin-add-{table}', [AdminController::class, 'adminAdd']);
    Route::get('/admin-add-{table}/{id}', [AdminController::class, 'adminAdd']);
    Route::post('/admin-add-{table}', [AdminController::class, 'adminSave']);
    Route::post('/admin-add-{table}/{id}', [AdminController::class, 'adminSave']);
});
