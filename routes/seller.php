<?php


use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductPersoController;
use App\Http\Controllers\Seller\InventoryController;
use App\Http\Controllers\Seller\SellerAuthController;
use App\Http\Controllers\Seller\SellerDashboardController;
use App\Http\Controllers\Seller\SellerHomeController;

Route::get('/', [SellerHomeController::class, 'index'])->name('home');
Route::get('/docs/{document}', [SellerHomeController::class, 'docs']);
Route::get('/pricing', [SellerHomeController::class, 'pricing'])->name('pricing');

Route::get('/start-up/{plan}', [SellerHomeController::class, 'start'])->middleware(['auth', 'verified'])->name('start-up');
Route::post('/start-up', [SellerHomeController::class, 'startUp'])->middleware(['auth', 'verified'])->name('start-up.perform');

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

    Route::delete('/product/{product}/delete', [ProductController::class, 'destroy'])->middleware('password.confirm:seller.password.confirm')->name('products.delete');

    /**
     * Product inventory routes resource (Index, Create(Slideover), Store, Update(Only if aviable), Destroy )
     */
    Route::get('/product/{product}/inventory', [InventoryController::class, 'index'])->name('products.inventory');
    Route::get('/product/{product}/inventary/add', [InventoryController::class, 'create'])->name('products.inventory.create');
    Route::get('/product/{product}/inventory/{page}', [InventoryController::class, 'index']);

    Route::post('/product/{product}/inventory/add', [InventoryController::class, 'store'])->name('products.inventory.store');
    Route::put('/product/inventory/{inventory}', [InventoryController::class, 'update'])->name('products.inventory.update');
    Route::delete('/product/inventory/{inventory}', [InventoryController::class, 'destroy'])->name('products.inventory.destroy');
    
    /**
     * More personalization of the product page (Personalizar)
     */
    Route::get('/product/{product}/personalizar', [ProductPersoController::class, 'index'])->name('products.perso');
    Route::get('/product/{product}/personalizar/add', [ProductPersoController::class, 'create'])->name('products.perso.create');
    Route::post('/product/{product}/personalizar/add', [ProductPersoController::class, 'store'])->name('products.perso.store');
}
);

Route::post('/categories/get', [ProductController::class, 'getRequiredCategoryData'])->name('categories.get');
Route::post('/modelos/get', [ProductController::class, 'getModelos'])->name('modelos.get');

Route::controller(SellerAuthController::class)->middleware(['guest'])->group(function () {

    Route::get('/login', 'ShowLoginForm')->name('auth.login');
    Route::post('/login', 'login');

}
);

Route::controller(SellerAuthController::class)->middleware(['auth'])->group(function () {

    Route::post('/logout', 'logout')->name('logout');

});


?>