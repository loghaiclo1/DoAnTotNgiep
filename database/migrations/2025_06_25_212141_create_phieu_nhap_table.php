<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('phieu_nhap', function (Blueprint $table) {
            $table->id('MaPhieuNhap');
            $table->date('NgayNhap');
            $table->bigInteger('MaKhachHang'); // người nhập (admin)
            $table->text('GhiChu')->nullable();
            $table->timestamps();

            // Khóa ngoại tới bảng khachhang
            $table->foreign('MaKhachHang')
                  ->references('MaKhachHang')
                  ->on('khachhang')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('phieu_nhap');
    }
};
