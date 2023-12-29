<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HeadController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LeaveFormController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\CompensatoryTOController;
use App\Http\Controllers\CompassionateTOController;


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

Route::get('/dashboard',      [HomeController::class, 'index'])->name('home');
Route::get('admin/dashboard', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');

Route::get('/create',                    [CompassionateTOController::class, 'create'])->name('compassionateTO.create');
Route::post('/store',                    [CompassionateTOController::class, 'store'])->name('compassionateTO.store');
Route::get('/compassionate-time-off',    [CompassionateTOController::class, 'index'])->name('compassionateTO.index'); //user compassionate records
Route::get('/compassionateTO/form/{id}', [CompassionateTOController::class, 'form'])->name('compassionateTO.form');

Route::get('/create-leave', [LeaveFormController::class, 'create'])->name('leaveForm.createLeave');
Route::post('/store-leave', [LeaveFormController::class, 'store'])->name('leaveForm.store');
Route::get('/index-leave',  [LeaveFormController::class, 'index'])->name('leaveForm.index'); //user leave records
Route::get('/leave/form{id}', [LeaveFormController::class, 'form'])->name('leave.form');

Route::get('/createCompensatory', [CompensatoryTOController::class, 'create'])->name('compensatoryTO.createCompensatory');

Route::get('/leave-request/compassionate-time-off',        [LeaveRequestController::class, 'compassionateTO'])->name('leave-request.compassionateTO');
Route::patch('/leave-request/compassionate-time-off/{id}', [LeaveRequestController::class, 'update'])->name('leave-request.compassionateTO.update');

Route::get('/leave-request/leaveApp',                      [LeaveRequestController::class, 'leave'])->name('leave-request.leaveApp');// employees request to chief
Route::patch('/leave-request/leaveApp/{id}',               [LeaveRequestController::class, 'updateLeave'])->name('leave-request.leaveApp.update');

Route::get('/admin/leave-request/compassionate-time-off',        [AdminController::class, 'compassionateTO'])->name('admin-leave-request.compassionateTO');
Route::get('/admin/leave-request/leave',                         [AdminController::class, 'leaveAdmin'])->name('admin-leave-request.leave');
Route::patch('/admin/leave-request/compassionate-time-off/{id}', [AdminController::class, 'update'])->name('admin-leave-request.compassionateTO.update');
Route::patch('/admin/leave-request/leave/{id}',                  [AdminController::class, 'updateAdmin'])->name('admin-leave-request.leaveApp.update');
Route::get('/admin/application-summary/compassionate-time-off',  [AdminController::class, 'compassionateTOApplicationSummary'])->name('admin-application-summary.compassionateTO'); // admin recorded submission
Route::get('/admin/application-summary/leave',                   [AdminController::class, 'leaveApplicationSummary'])->name('admin-application-summary.leave'); // admin recorded submission

Route::get('/head/application-summary/compassionate-time-off',   [HeadController::class, 'compassionateTOApplicationSummaryHead'])->name('head-application-summary.compassionateTO'); // head recorded submission
Route::get('/head/application-summary/leave',                    [HeadController::class, 'leaveApplicationSummaryHead'])->name('head-application-summary.leave'); // head recorded submission
