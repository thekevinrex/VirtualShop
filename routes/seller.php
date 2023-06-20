<?php

use App\Http\Controllers\Product\InventoryController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Product\ProductPersoController;
use App\Http\Controllers\Product\VideoController;
use App\Http\Controllers\Seller\SellerAuthController;
use App\Http\Controllers\Seller\SellerDashboardController;
use App\Http\Controllers\Seller\SellerHomeController;
use App\Http\Controllers\Seller\SellerSettingsController;

Route::get('/', [SellerHomeController::class, 'index'])->name('home');
Route::get('/docs/{document}', [SellerHomeController::class, 'docs']);
Route::get('/pricing', [SellerHomeController::class, 'pricing'])->name('pricing');

Route::get('/start-up/{plan}', [SellerHomeController::class, 'start'])->middleware(['auth', 'verified'])->name('start-up');
Route::post('/start-up', [SellerHomeController::class, 'startUp'])->middleware(['auth', 'verified']);

Route::middleware(['auth', 'verified', 'seller'])->group(function () {

    /**
     * dashboard routes
     */
    Route::get('/dashboard', [SellerDashboardController::class, 'index'])->name('dashboard');

    /**
     * Product routes resource (Index, Create, Store, Edit, Update, Destroy)
     */
    Route::get('/product', [ProductController::class, 'index'])->name('products');
    Route::get('/product/add', [ProductController::class, 'create'])->name('products.create');
    Route::post('/product/add', [ProductController::class, 'store'])->name('products.store');

    Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/product/{product}/edit', [ProductController::class, 'update'])->name('products.update');

    Route::delete('/product/{product}/delete', [ProductController::class, 'destroy'])->middleware('password.confirm')->name('products.delete');

    /**
     * Product inventory routes resource (Index, Create(Slideover), Store, Update(Only if aviable), Destroy )
     */
    Route::get('/product/{product}/inventory/{page?}', [InventoryController::class, 'index'])->name('products.inventory');
    Route::get('/product/{product}/inventary/add', [InventoryController::class, 'create'])->name('products.inventory.create');
    // Route::get('/product/{product}/inventory/', [InventoryController::class, 'index']);

    Route::post('/product/{product}/inventory/add', [InventoryController::class, 'store'])->name('products.inventory.store');
    Route::put('/product/inventory/{inventory}', [InventoryController::class, 'update'])->name('products.inventory.update');
    Route::delete('/product/inventory/{inventory}', [InventoryController::class, 'destroy'])->name('products.inventory.destroy');
    
    /**
     * More personalization of the product page (Personalizar)
     */
    Route::get('/product/{product}/personalizar', [ProductPersoController::class, 'index'])->name('products.perso');
    Route::get('/product/{product}/personalizar/add', [ProductPersoController::class, 'create'])->name('products.perso.create');
    Route::post('/product/{product}/personalizar/add', [ProductPersoController::class, 'store'])->name('products.perso.store');

    /**
     * Settings page 
     */
    Route::get('/settings/{view?}', [SellerSettingsController::class, 'index'])->name('settings');

    Route::put('/settings/info', [SellerSettingsController::class, 'updateInfo'])->name('settings.info.update');
    Route::put('/settings/payment', [SellerSettingsController::class, 'updatePayment'])->name('settings.payment.update');
    Route::put('/settings/address', [SellerSettingsController::class, 'updateAddress'])->name('settings.address.update');

    /**
     * Videos resource to provide the product with more beautiful pages
     */

    Route::get('/videos', [VideoController::class, 'index'])->name('videos');
    Route::get('/videos/add/upload', [VideoController::class, 'upload'])->name('videos');
}
);

Route::middleware(['guest'])->group(function () {
    Route::get('/login',[SellerAuthController::class, 'ShowLoginForm'])->name('auth.login');
    Route::post('/login', [SellerAuthController::class, 'login']);
});

Route::post('/logout', [SellerAuthController::class, 'logout'])->middleware('auth')->name('logout');


?>