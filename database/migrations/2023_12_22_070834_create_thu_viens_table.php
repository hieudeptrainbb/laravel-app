<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThuViensTable extends Migration
{
    public function up()
    {
        Schema::create('thu_viens', function (Blueprint $table) {
            $table->id();
            $table->string('ma_tai_lieu')->unique();
            $table->string('ten_nha_xuat_ban');
            $table->integer('so_ban_phat_hanh');
            $table->string('ten_tac_gia')->nullable();
            $table->integer('so_trang')->nullable();
            $table->integer('so_phat_hanh')->nullable();
            $table->string('thang_phat_hanh')->nullable();
            $table->date('ngay_phat_hanh')->nullable();
            // Thêm các cột khác của model ThuVien ở đây

            $table->string('loai_tai_lieu'); // Dùng để phân biệt loại tài liệu: sach, tap_chi, bao
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('thu_viens');
    }
}
