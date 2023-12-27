<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('cabinet_id');
            $table->integer('quantity');
            $table->string('cabinet_type');
            $table->decimal('rental_price', 10, 2); // Thêm trường rental_price kiểu số thập phân
            $table->decimal('total_hours', 8, 2); // Thêm trường total_hours kiểu số thập phân
            $table->string('status');
            $table->dateTime('start_date'); // Thay đổi kiểu dữ liệu thành dateTime
            $table->dateTime('end_date'); // Thay đổi kiểu dữ liệu thành dateTime
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('cabinet_id')->references('id')->on('cabinets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rentals');
    }
}
