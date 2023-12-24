<?php

namespace App\Http\Controllers\OOP;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AffiliateController extends Controller
{
    public $name;
    public $balance = 0;
    public $upperAffiliate = null;
    public $subAffiliates = [];
    public $customers = [];

    public function __construct($name) {
        $this->name = $name;
    }

    public function refer($obj) {
        // Logic giới thiệu Affiliate hoặc Customer mới
        // Ví dụ:
        if ($obj instanceof Affiliate) {
            $this->subAffiliates[] = $obj;
            $obj->upperAffiliate = $this;
        } elseif ($obj instanceof Customer) {
            $this->customers[] = $obj;
            $obj->affiliate = $this;
        }
    }

    public function withDraw($amount) {
        if ($this->balance >= $amount && $amount >= 100) {
            $this->balance -= $amount;
            echo "Withdrawal of $amount successful.";
        } else {
            echo "Withdrawal failed. Balance insufficient or below the limit.";
        }
    }

    // Các phương thức khác...
}
