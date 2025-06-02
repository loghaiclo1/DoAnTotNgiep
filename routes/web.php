<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;


Route::get('/', [HomeController::class, 'index']);
Route::get('/about', [HomeController::class, 'about']);
Route::get('/cart', [HomeController::class, 'cart']);
Route::get('/category', [HomeController::class, 'category']);
Route::get('/checkout', [HomeController::class, 'checkout']);
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/productdetail', [HomeController::class, 'productdetail']);

