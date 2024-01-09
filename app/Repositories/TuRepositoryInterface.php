<?php

namespace App\Repositories;

interface TuRepositoryInterface
{
    public function all();

    public function create();

    public function edit($id);

    public function find($id);

    public function update($id);

    public function delete($id);

    public function allPhanLoaiNgan();

    public function createPhanLoaiNgan();

    public function editPhanLoaiNgan($id);

    public function findPhanLoaiNgan($id);

    public function updatePhanLoaiNgan($id);

    public function deletePhanLoaiNgan($id);

    public function allNgan();
    public function createNgan();

    public function editNgan($id);

    public function findNgan($id);

    public function updateNgan($id);
    public function deleteNgan($id);
}
