<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chi_tiet_phieu_nhap', function (Blueprint $table) {
            $table->id('MaChiTietNhap');
            $table->unsignedBigInteger('MaPhieuNhap');
            $table->bigInteger('MaSach'); // 
            $table->integer('SoLuong');
            $table->decimal('DonGia', 15, 2);
            $table->timestamps();

            $table->foreign('MaPhieuNhap')
                ->references('MaPhieuNhap')
                ->on('phieu_nhap')
                ->onDelete('cascade');

            $table->foreign('MaSach')
                ->references('MaSach')
                ->on('sach')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chi_tiet_phieu_nhap');
    }
};
