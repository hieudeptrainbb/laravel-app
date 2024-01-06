<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ngan extends Model
{
    protected $table = 'ngan';

    protected $fillable = [
        'ten_ngan',
        'phanloai_id',
        'phanloai_ngan_id',
        'phanloai_ngan',
        'trang_thai',
    ];

    public function phanLoaiNgan()
    {
        return $this->belongsTo(PhanloaiNgan::class, 'phanloai_ngan_id', 'id');
    }
    public function thueTus()
    {
        return $this->hasMany(ThueTu::class, 'ngan_id', 'id')->onDelete('cascade');
    }

}
