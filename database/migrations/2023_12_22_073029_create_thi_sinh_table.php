<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThiSinhTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thi_sinhs', function (Blueprint $table) {
            $table->id();
            $table->string('so_bao_danh')->unique();
            $table->string('ho_ten');
            $table->string('dia_chi');
            $table->integer('muc_uu_tien');
            $table->char('khoi_thi', 1); // A, B, C
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('thi_sinhs');
    }
}
