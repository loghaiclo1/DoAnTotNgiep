<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PhuongXa;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class PhuongXaSeeder extends Seeder
{
    public function run()
    {
        try {
            // Đọc file JSON
            $json = File::get(storage_path('app/vn_provinces.json'));
            $data = json_decode($json, true);

            if (!$data) {
                Log::error('PhuongXaSeeder: Không thể giải mã file JSON.');
                throw new \Exception('File JSON không hợp lệ.');
            }

            // Thêm phường/xã
            $count = 0;
            foreach ($data as $tinhThanh) {
                foreach ($tinhThanh['districts'] as $quanHuyen) {
                    foreach ($quanHuyen['wards'] as $phuongXa) {
                        PhuongXa::updateOrCreate(
                            ['id' => $phuongXa['code']],
                            [
                                'ten' => $phuongXa['name'],
                                'quan_huyen_id' => $quanHuyen['code']
                            ]
                        );
                        $count++;
                    }
                }
            }

            Log::info('PhuongXaSeeder: Đã import '.$count.' phường/xã.');
        } catch (\Exception $e) {
            Log::error('PhuongXaSeeder: Lỗi khi import dữ liệu: '.$e->getMessage());
            throw $e;
        }
    }
}
