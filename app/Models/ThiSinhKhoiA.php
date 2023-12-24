<?php

namespace App\Models;

use App\Models\ThiSinh;

class ThiSinhKhoiA extends ThiSinh
{
    protected $table = 'thi_sinh_khoi_a';

    // Định nghĩa các môn thi cho khối A
    protected $mon_thi = ['Toán', 'Lý', 'Hoá'];
}
