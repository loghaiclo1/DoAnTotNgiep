<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\QuanHuyen;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class QuanHuyenSeeder extends Seeder
{
    public function run()
    {
        try {
            // Đọc file JSON
            $json = File::get(storage_path('app/vn_provinces.json'));
            $data = json_decode($json, true);

            if (!$data) {
                Log::error('QuanHuyenSeeder: Không thể giải mã file JSON.');
                throw new \Exception('File JSON không hợp lệ.');
            }

            // Thêm quận/huyện
            $count = 0;
            foreach ($data as $tinhThanh) {
                foreach ($tinhThanh['districts'] as $quanHuyen) {
                    QuanHuyen::updateOrCreate(
                        ['id' => $quanHuyen['code']],
                        [
                            'ten' => $quanHuyen['name'],
                            'tinh_thanh_id' => $tinhThanh['code']
                        ]
                    );
                    $count++;
                }
            }

            Log::info('QuanHuyenSeeder: Đã import '.$count.' quận/huyện.');
        } catch (\Exception $e) {
            Log::error('QuanHuyenSeeder: Lỗi khi import dữ liệu: '.$e->getMessage());
            throw $e;
        }
    }
}
