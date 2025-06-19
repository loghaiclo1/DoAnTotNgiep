<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TinhThanh;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class TinhThanhSeeder extends Seeder
{
    public function run()
    {
        try {
            // Đọc file JSON
            $json = File::get(storage_path('app/vn_provinces.json'));
            $data = json_decode($json, true);

            if (!$data) {
                Log::error('TinhThanhSeeder: Không thể giải mã file JSON.');
                throw new \Exception('File JSON không hợp lệ.');
            }

            // Thêm tỉnh/thành
            foreach ($data as $tinhThanh) {
                TinhThanh::updateOrCreate(
                    ['id' => $tinhThanh['code']],
                    ['ten' => $tinhThanh['name']]
                );
            }

            Log::info('TinhThanhSeeder: Đã import '.count($data).' tỉnh/thành.');
        } catch (\Exception $e) {
            Log::error('TinhThanhSeeder: Lỗi khi import dữ liệu: '.$e->getMessage());
            throw $e;
        }
    }
}
