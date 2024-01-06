<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'phanloai_id',
        'ngan',
        'ngan_id',
        'action',
    ];
    // Các mối quan hệ
    public function phanLoai()
    {
        return $this->belongsTo(PhanLoai::class, 'phanloai_id', 'id');
    }
    public function nganTu()
    {
        return $this->belongsTo(Ngan::class, 'ngan_id', 'id');
    }
}
