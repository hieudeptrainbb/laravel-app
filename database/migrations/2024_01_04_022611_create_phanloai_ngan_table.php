<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhanloaiNganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phanloai_ngan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('phanloai_id');
            $table->string('ten_tu');
            $table->string('ten_ngan');
            $table->decimal('gia', 8, 2);
            $table->timestamps();

            $table->foreign('phanloai_id')->references('id')->on('phan_loai');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phanloai_ngan');
    }
}
