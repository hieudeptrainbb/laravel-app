<?php

namespace App\Repositories\Repository;

use App\Models\Ngan;
use App\Models\PhanLoai;
use App\Models\PhanLoaiNgan;
use App\Repositories\TuRepositoryInterface;

class TuRepository implements TuRepositoryInterface
{
    public function all()
    {
        return PhanLoai::all();
    }

    public function create()
    {
        return PhanLoai::create();
    }

    public function edit($id)
    {
        $phanLoai = PhanLoai::findOrFail($id);
        $phanLoai->update();
        return $phanLoai;
    }

    public function find($id)
    {
        return PhanLoai::findOrFail($id);
    }

    public function update($id)
    {
        $phanLoai = PhanLoai::findOrFail($id);
        $phanLoai->update();
        return $phanLoai;
    }

    public function delete($id)
    {
        $phanLoai = PhanLoai::findOrFail($id);
        return $phanLoai->delete();
    }

//   --- Phân Loại Ngăn ---
    public function allPhanLoaiNgan()
    {
        return PhanLoaiNgan::all();
    }

    public function createPhanLoaiNgan()
    {
        return PhanLoaiNgan::create();
    }

    public function editPhanLoaiNgan($id)
    {
        $phanloaiNgan = PhanLoaiNgan::findOrFail($id);
        $phanloaiNgan->update();
        return $phanloaiNgan;
    }

    public function findPhanLoaiNgan($id)
    {
        return PhanLoaiNgan::findOrFail($id);
    }

    public function updatePhanLoaiNgan($id)
    {
        $phanloaiNgan = PhanLoaiNgan::findOrFail($id);
        $phanloaiNgan->update();
        return $phanloaiNgan;
    }

    public function deletePhanLoaiNgan($id)
    {
        $phanloaiNgan = PhanLoaiNgan::findOrFail($id);
        return $phanloaiNgan->delete();
    }

//    --- Ngăn ---
    public function allNgan()
    {
        return Ngan::all();
    }

    public function createNgan()
    {
        return Ngan::create();
    }

    public function editNgan($id)
    {
        $ngan = Ngan::findOrFail($id);
        $ngan->update();
        return $ngan;
    }

    public function findNgan($id)
    {
        return Ngan::findOrFail($id);
    }

    public function updateNgan($id)
    {
        $ngan = Ngan::findOrFail($id);
        $ngan->update();
        return $ngan;
    }

    public function deleteNgan($id)
    {
        $ngan = Ngan::findOrFail($id);
        return $ngan->delete();
    }
}
