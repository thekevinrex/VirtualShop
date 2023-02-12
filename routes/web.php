<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;

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

Route::middleware(['splade'])->group(function () {

    
    Route::get('/', [HomeController::class, 'index'])->name('home');    
    
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/docs', fn() => view('docs'))->name('docs');
    });

    Route::prefix('/admin')->group(function () {
        Route::middleware(['auth', 'verified', 'admin'])->group(function () {
            Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.index');
        }
        );
    });

    // Registers routes to support password confirmation in Form and Link components...
    Route::spladePasswordConfirmation();

    // Registers routes to support Table Bulk Actions and Exports...
    Route::spladeTable();

    // Registers routes to support async File Uploads with Filepond...
    Route::spladeUploads();

    Route::post('/upload', [UploadController::class, 'upload'])->name('upload');
    Route::post('/municipio/get', [AddressController::class, 'getMunicipios'])->name('municipios.get');

    Route::controller(AuthController::class)->group(function () {

        Route::middleware('guest')->group(function () {

            Route::get('/login', 'ShowLoginForm')->name('auth.login');
            Route::post('/login', 'login');

            Route::get('/register', 'ShowRegisterForm')->name('auth.register');
            Route::post('/register', 'register');

            Route::get('/forgot-password', 'ShowForgotPasswordForm')->name('password.request');
            Route::post('/forgot-password', 'SendResetEmailToken')->name('password.email');

            Route::get('/reset-password/{token}', 'ShowResetPasswordForm')->name('password.reset');
            Route::post('/reset-password', 'resetPassword')->name('password.update');

        });

        Route::middleware('auth')->group(function () {

            Route::post('/logout', 'logout')->name('logout');

            Route::get('/password-confirm', 'showPasswordConfirmForm')->name('password.confirm');
            Route::post('/password-confirm', 'passwordConfirm');

            Route::get('/verify-email', 'showResendVerificationEmail')->name('verification.notice');
            Route::get('/verify-email/verify/{id}/{hash}', 'verify')->middleware(['signed'])->name('verification.verify');
            Route::post('/verify-emails', 'resend')->name('verification.send');
        });

    }
    );
});