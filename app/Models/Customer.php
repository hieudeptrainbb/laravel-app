<?php

namespace App\Models;

// app/Models/Customer.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['name', 'address'];

    public function affiliate()
    {
        return $this->belongsTo(Affiliate::class);
    }

    public function placeOrder($total)
    {
        $affiliate = $this->affiliate;
        if ($affiliate) {
            $commission = $total * 0.1; // 10% cho Affiliate
            $affiliate->balance += $commission;
            $affiliate->save();
            $storeOwner = StoreOwner::first(); // Đây chỉ là ví dụ, cần xác định StoreOwner thích hợp
            $storeOwner->balance += $total - $commission;
            $storeOwner->save();
        }
    }
}
