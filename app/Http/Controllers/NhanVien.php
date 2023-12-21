<?php
namespace App\Http\Controllers;

class NhanVien extends CanBo
{
    protected $cong_viec;

    public function __construct($name, $age, $gender, $address, $cong_viec)
    {
        parent::__construct($name, $age, $gender, $address);
        $this->cong_viec = $cong_viec;
    }

    public function getCongViec()
    {
        return $this->cong_viec;
    }
}
