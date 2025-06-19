<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('phuong_xas', function (Blueprint $table) {
            $table->id();
            $table->string('ten');
            $table->unsignedBigInteger('quan_huyen_id');
            $table->timestamps();

            $table->foreign('quan_huyen_id')->references('id')->on('quan_huyens')->onDelete('cascade');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('phuong_xas');
    }
};
