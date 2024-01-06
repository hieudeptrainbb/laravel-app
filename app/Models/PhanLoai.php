<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhanLoai extends Model
{
    use HasFactory;
    protected $table = 'phan_loai';
    protected $fillable = [
        'ma_tu',
        'ten',
        'gia',
    ];
    public function phanloaiNgans()
    {
        return $this->hasMany(PhanloaiNgan::class, 'phanloai_id', 'id')->onDelete('cascade');
    }

    public function events()
    {
        return $this->hasMany(Event::class, 'phanloai_id', 'id')->onDelete('cascade');
    }
}
