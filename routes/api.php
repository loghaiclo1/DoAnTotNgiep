<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home\DiaChiController;
use App\Http\Controllers\Admin\TacGiaController;

Route::get('/quan-huyen/{tinhThanhId}', [DiaChiController::class, 'layQuanHuyen']);
Route::get('/phuong-xa/{quanHuyenId}', [DiaChiController::class, 'layPhuongXa']);
Route::get('/get-diachi-from-xa/{id}', [TacGiaController::class, 'getDiaChiFromXa']);
