<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\User\AuthController as UserAuthController;
use App\Http\Controllers\User\ForgotPasswordController as UserForgotPasswordController;
use App\Http\Controllers\Admin\ForgotPasswordController as AdminForgotPasswordController;

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

Route::get('/', function () {
    return view('welcome');
});



Route::get('admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login')->middleware('guest');
Route::post('admin/login', [AdminAuthController::class, 'login'])->name('admin.login');
Route::get('admin/forgot-password',[AdminForgotPasswordController::class, 'forgotPasswordForm'])->name('admin.forgot-password')->middleware('guest');
Route::post('admin/forgot-password',[AdminForgotPasswordController::class, 'sendResetLink'])->name('admin.forgot-password');
Route::get('admin/password-reset',[AdminForgotPasswordController::class,'resetFrom'])->name('admin.password.reset');
Route::post('admin/password-reset-post',[AdminForgotPasswordController::class,'resetPassword'])->name('admin.password.reset.post');

Route::group(['middleware' => 'auth:admin'], function () {

    Route::get('/admin/dashboard', function () {

        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::get('admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});
Route::get('user/login', [UserAuthController::class, 'showLoginForm'])->name('user.login')->middleware('guest');
Route::post('user/login', [UserAuthController::class, 'login'])->name('user.login');
Route::get('user/forgot-password',[UserForgotPasswordController::class, 'forgotPasswordForm'])->name('user.forgot-password')->middleware('guest');
Route::post('user/forgot-password',[UserForgotPasswordController::class, 'sendResetLink'])->name('user.forgot-password');
Route::get('user/password-reset',[UserForgotPasswordController::class,'resetFrom'])->name('password.reset');
Route::post('user/password-reset-post',[UserForgotPasswordController::class,'resetPassword'])->name('password.reset.post');


Route::group(['middleware' => 'auth'], function () {

    Route::get('/user/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');
    Route::get('user/logout', [UserAuthController::class, 'logout'])->name('user.logout');
});
