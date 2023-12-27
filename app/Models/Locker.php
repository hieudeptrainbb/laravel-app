<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locker extends Model
{
    use HasFactory;
    protected $fillable = [
        'locker_number',
        'locker_type',
        'is_used',
        // Các trường khác nếu cần
    ];

    // Relationship với Rental (lịch sử thuê)
    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }
}
