<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpdatePhanloaiNganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ngan', function (Blueprint $table) {
            $table->unsignedBigInteger('phanloai_ngan_id')->nullable();
            $table->string('phanloai_ngan')->nullable();

            $table->foreign('phanloai_ngan_id')->references('id')->on('phanloai_ngan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ngan', function (Blueprint $table) {
            $table->dropForeign(['phanloai_ngan_id']);
            $table->dropColumn('phanloai_ngan_id');
            $table->dropColumn('phanloai_ngan');
        });
    }
}
