<?php

namespace App\Http\Controllers\OOP;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OderController extends Controller
{
    public $total;

    public function __construct($total) {
        $this->total = $total;
    }
}
