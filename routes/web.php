<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::prefix('products')->group(function(){
    Route::get('/', [ProductController::class, 'index'])->name('products');
    Route::get('/create', [ProductController::class, 'create'])->name('create.product');
    Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('edit.product');
    Route::post('/create', [ProductController::class, 'store']);
    Route::put('/edit/{product}', [ProductController::class, 'update'])->name('update.product');
    Route::delete('/delete/{product}', [ProductController::class, 'delete'])->name('delete.product');
    Route::get('/export', [ProductController::class, 'export'])->name('export.product');
});

