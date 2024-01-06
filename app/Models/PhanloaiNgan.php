<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhanloaiNgan extends Model
{
    use HasFactory;

    protected $table = 'phanloai_ngan';

    protected $fillable = [
        'phanloai_id',
        'ten_ngan',
        'ten_tu',
        'gia',
    ];

    public function phanLoai()
    {
        return $this->belongsTo(PhanLoai::class, 'phanloai_id', 'id');
    }
    public function ngans()
    {
        return $this->hasMany(Ngan::class, 'phanloai_ngan_id', 'id')->onDelete('cascade');
    }
}
