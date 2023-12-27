<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'user_id',
        'cabinet_id',
        'quantity',
        'cabinet_type',
        'rental_price',
        'total_hours',
        'status',
        'start_date',
        'end_date',
    ];

    // Relationship với User (người dùng)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship với Locker (tủ đồ)
    public function locker()
    {
        return $this->belongsTo(Locker::class);
    }
}
