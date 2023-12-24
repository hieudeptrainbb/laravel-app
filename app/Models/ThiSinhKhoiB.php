<?php

namespace App\Models;

use App\Models\ThiSinh;

class ThiSinhKhoiB extends ThiSinh
{
    protected $table = 'thi_sinh_khoi_b';

    // Định nghĩa các môn thi cho khối B
    protected $mon_thi = ['Toán', 'Hoá', 'Sinh'];
}
