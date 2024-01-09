<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public  function tinh($a, $b)
    {
        $cong = $a + $b;
        $tru = $a - $b;
        $nhan = $a * $b;
        $chia = $a / $b;
        echo ('Kết quả là phép cộng là: '.$cong .'<br>');
        echo ('Kết quả là phép trừ là: '.$tru.'<br>');
        echo ('Kết quả là phép nhân là: '.$nhan.'<br>');
        echo ('Kết quả là phép chia là: '.$chia.'<br>');
    }

    public function mang()
    {
        $mang = [];

        for ($i = 1; $i <=10 ; $i++) {
            $mang[] = $i;
        }

        $string = implode('<br> ', $mang);

        echo $string;
    }
}
