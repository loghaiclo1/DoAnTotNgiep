<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quan_huyens', function (Blueprint $table) {
            $table->id();
            $table->string('ten');
            $table->unsignedBigInteger('tinh_thanh_id');
            $table->foreign('tinh_thanh_id')->references('id')->on('tinh_thanhs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quan_huyens');
    }
};
