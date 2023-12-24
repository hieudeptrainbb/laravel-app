<?php

namespace App\Http\Controllers\OOP;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public $name;
    public $address;
    public $affiliate = null;

    public function __construct($name, $address) {
        $this->name = $name;
        $this->address = $address;
    }

    public function placeOrder($total) {
        $commission = $total * 0.1;
        $this->affiliate->balance += $commission;
        $this->affiliate->upperAffiliate->balance += ($total - $commission);
    }

    // Các phương thức khác...
}
