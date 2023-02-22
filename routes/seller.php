<?php


use App\Http\Controllers\ProductController;
use App\Http\Controllers\Seller\SellerAuthController;
use App\Http\Controllers\Seller\SellerDashboardController;
use App\Http\Controllers\Seller\SellerHomeController;

Route::middleware(['splade'])->group(function () {

    Route::get('/', [SellerHomeController::class, 'index'])->name('home');
    Route::get('/docs/{document}', [SellerHomeController::class, 'docs']);
    Route::get('/pricing', [SellerHomeController::class, 'pricing'])->name('pricing');

    Route::get('/start-up/{plan}', [SellerHomeController::class, 'start'])->middleware(['auth:seller', 'verified:seller.verification.notice'])->name('start-up');
    Route::post('/start-up', [SellerHomeController::class, 'startUp'])->middleware(['auth:seller', 'verified:seller.verification.notice'])->name('start-up.perform');

    Route::middleware(['auth:seller', 'verified:seller.verification.notice', 'seller'])->group(function () {

        Route::get('/dashboard', [SellerDashboardController::class, 'index'])->name('dashboard');

        Route::get('/product', [ProductController::class, 'index'])->name('products');
        Route::get('/product/add', [ProductController::class, 'create'])->name('products.create');
    }
    );

    Route::post('/categories/get', [ProductController::class, 'getRequiredCategoryData'])->name('categories.get');
    Route::post('/modelos/get', [ProductController::class, 'getModelos'])->name('modelos.get');

    Route::controller(SellerAuthController::class)->middleware(['guest:seller'])->group(function () {
        Route::get('/login', 'ShowLoginForm')->name('auth.login');
        Route::post('/login', 'login');

        Route::get('/register', 'ShowRegisterForm')->name('auth.register');
        Route::post('/register', 'register');

        Route::get('/forgot-password', 'ShowForgotPasswordForm')->name('password.request');
        Route::post('/forgot-password', 'SendResetEmailToken')->name('password.email');

        Route::get('/reset-password/{token}', 'ShowResetPasswordForm')->name('password.reset');
        Route::post('/reset-password', 'resetPassword')->name('password.update');
    }
    );

    Route::controller(SellerAuthController::class)->middleware(['auth:seller'])->group(function () {
        Route::get('/verify-email', 'showResendVerificationEmail')->name('verification.notice');
        Route::get('/verify-email/verify/{id}/{hash}','verify')->middleware(['signed'])->name('verification.verify');
        Route::post('/verify-emails', 'resend')->name('verification.send');

        Route::post('/logout', 'logout')->name('logout');

        Route::get('/password-confirm', 'showPasswordConfirmForm')->name('password.confirm');
        Route::post('/password-confirm', 'passwordConfirm');
    });



});

?>