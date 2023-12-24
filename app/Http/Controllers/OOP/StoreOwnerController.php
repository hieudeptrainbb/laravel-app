<?php

namespace App\Http\Controllers\OOP;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StoreOwnerController extends Controller
{
    public $name;
    public $balance = 0;

    public function __construct($name) {
        $this->name = $name;
    }

    public function printBalance() {
        echo "Store Owner's balance: " . $this->balance;
    }
}
