<?php

namespace App\Models;

use App\Models\ThiSinh;

class ThiSinhKhoiC extends ThiSinh
{
    protected $table = 'thi_sinh_khoi_c';

    // Định nghĩa các môn thi cho khối C
    protected $mon_thi = ['Văn', 'Sử', 'Địa'];
}
