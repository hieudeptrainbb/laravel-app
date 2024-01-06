<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThueTuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thue_tu', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('phanloai_id');
            $table->unsignedBigInteger('ngang_id');
            $table->dateTime('ngay_gio_bat_dau');
            $table->dateTime('ngay_gio_ket_thuc');
            $table->integer('tong_so_gio');
            $table->decimal('don_gia', 8, 2);
            $table->decimal('thanh_tien', 8, 2);
            $table->string('trang_thai');
            $table->timestamps();

            $table->foreign('phanloai_id')->references('id')->on('phan_loai');
            $table->foreign('ngang_id')->references('id')->on('ngan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('thue_tu');
    }
}
