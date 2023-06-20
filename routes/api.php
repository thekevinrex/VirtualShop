<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\Product\VideoController;
use App\Http\Controllers\UploadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/upload/video', [VideoController::class, 'store'])->middleware('auth:sanctum')->name('upload-video');

Route::post('/municipio/get', [AddressController::class, 'getMunicipios'])->name('municipios.get');
Route::post('/upload'       , [UploadController::class , 'upload'])->name('upload');

Route::post('/categories/get', [CategoryController::class, 'getRequiredCategoryData'])->name('categories.get');
Route::post('/modelos/get'   , [BrandController::class   , 'getModels'])->name('modelos.get');


// Route::post('/register');
