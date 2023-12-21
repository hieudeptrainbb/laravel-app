<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CongNhan;
use App\Http\Controllers\KySu;
use App\Http\Controllers\NhanVien;

class CanBoController extends Controller
{
    public function getCongNhanDetails()
    {
        $congNhan = new CongNhan('Nguyen Van Cong', 30, 'Nam', 'Hanoi', 5);

        // Truy cập vào thuộc tính của cán bộ công nhân
        $name = $congNhan->getName();
        $age = $congNhan->getAge();
        $gender = $congNhan->getGender();
        $address = $congNhan->getAddress();
        $bac = $congNhan->getBac();

        return view('cong_nhan_details', compact('name', 'age', 'gender', 'address', 'bac'));
    }

    public function getKysu()
    {
        $kySu = new KySu('Nguyen Van Cong', 30, 'Nam', 'Hanoi', 'CNTT');

        // Truy cập vào thuộc tính của cán bộ công nhân
        $name = $kySu->getName();
        $age = $kySu->getAge();
        $gender = $kySu->getGender();
        $address = $kySu->getAddress();
        $nghanh_dao_tao = $kySu->getNghanhDaoTao();

        return view('ky_su', compact('name', 'age', 'gender', 'address', 'nghanh_dao_tao'));
    }

    public function getNhanVien()
    {
        $nhanVien = new NhanVien('Nguyen Van Cong', 30, 'Nam', 'Hanoi', 'Kế toán');

        // Truy cập vào thuộc tính của cán bộ công nhân
        $name = $nhanVien->getName();
        $age = $nhanVien->getAge();
        $gender = $nhanVien->getGender();
        $address = $nhanVien->getAddress();
        $cong_viec = $nhanVien->getCongViec();

        return view('nhan_vien', compact('name', 'age', 'gender', 'address', 'cong_viec'));
    }


}
