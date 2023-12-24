<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThiSinh extends Model
{
    protected $table = 'thi_sinhs';

    protected $fillable = ['so_bao_danh', 'ho_ten', 'dia_chi', 'muc_uu_tien', 'khoi_thi'];
}

