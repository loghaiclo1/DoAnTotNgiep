<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home\DiaChiController;

Route::get('/quan-huyen/{tinhThanhId}', [DiaChiController::class, 'layQuanHuyen']);
Route::get('/phuong-xa/{quanHuyenId}', [DiaChiController::class, 'layPhuongXa']);
