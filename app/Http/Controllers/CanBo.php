<?php

namespace App\Http\Controllers;

class CanBo
{
    protected $name;
    protected $age;
    protected $gender;
    protected $address;

    public function __construct($name, $age, $gender, $address)
    {
        $this->name = $name;
        $this->age = $age;
        $this->gender = $gender;
        $this->address = $address;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function getAddress()
    {
        return $this->address;
    }
}
