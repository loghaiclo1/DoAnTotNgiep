<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\QuanHuyen;
use App\Models\PhuongXa;

class DiaChiController extends Controller
{
    public function layQuanHuyen($tinhThanhId)
    {
        return QuanHuyen::where('tinh_thanh_id', $tinhThanhId)
                        ->select('id', 'ten')
                        ->orderBy('ten')
                        ->get();
    }

    public function layPhuongXa($quanHuyenId)
    {
        return PhuongXa::where('quan_huyen_id', $quanHuyenId)
                        ->select('id', 'ten')
                        ->orderBy('ten')
                        ->get();
    }
}
