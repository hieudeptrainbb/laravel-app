<?php

namespace App\Http\Controllers;

    class CongNhan extends CanBo
{
    protected $bac;

    public function __construct($name, $age, $gender, $address, $bac)
    {
        parent::__construct($name, $age, $gender, $address);
        $this->bac = $bac;
    }

    public function getBac()
    {
        return $this->bac;
    }
}
