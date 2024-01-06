<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ngan', function (Blueprint $table) {
            $table->id();
            $table->string('ten_ngan');
            $table->unsignedBigInteger('phanloai_id');
            $table->string('trang_thai');
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
        Schema::dropIfExists('ngan');
    }
}
