<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThueTu extends Model
{
    use HasFactory;
    protected $table = 'thue_tu';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'phanloai_id',
        'ngang_id',
        'ngay_gio_bat_dau',
        'ngay_gio_ket_thuc',
        'tong_so_gio',
        'don_gia',
        'thanh_tien',
        'trang_thai',
    ];

    // Các mối quan hệ
    public function ngan()
    {
        return $this->belongsTo(Ngan::class, 'ngang_id');
    }

    public function phanLoai() {
        return $this->belongsTo(PhanLoai::class, 'phanloai_id');
    }

}
