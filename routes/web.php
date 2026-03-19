<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
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


Route::get('/', [ProductController::class, 'index'])->name('index');
Route::get('/products/register', [ProductController::class, 'create'])->name('create');
Route::post('/products/register',[ProductController::class,'store'])->name('store');
Route::post('/products/{id}/update', [ProductController::class, 'update'])->name('update');
Route::get('/products/{id}',[ProductController::class, 'show'])->name('show');
Route::delete('/products/{id}/destroy', [ProductController::class, 'destroy'])->name('destroy');