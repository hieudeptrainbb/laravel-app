<?php

namespace App\Http\Controllers;

class KySu extends CanBo
{
    protected $nghanh_dao_tao;

    public function __construct($name, $age, $gender, $address, $nghanh_dao_tao)
    {
        parent::__construct($name, $age, $gender, $address);
        $this->nghanh_dao_tao = $nghanh_dao_tao;
    }

    public function getNghanhDaoTao()
    {
        return $this->nghanh_dao_tao;
    }
}
