<?php

namespace App\Http\Controllers;

use App\Models\PhanLoai;
use App\Repositories\TuRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TuController extends Controller
{
    private $tuRepository;

    public function __construct(TuRepositoryInterface $tuRepository)
    {
        $this->TuRepository = $tuRepository;
    }

    public function index()
    {
        $phanloais = $this->TuRepository->all();

        return view('admin.category.index_add_tu', ['phanloais' => $phanloais]);
    }


    public function create()
    {
        //
        $phanloais = $this->TuRepository->all();
        return view('admin.category.add_tu', ['phanloais' => $phanloais]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'ma_tu' => [
                'required',
                Rule::unique('phan_loai')->where(function ($query) use ($request) {
                    return $query->where('ma_tu', $request->ma_tu);
                }),
            ],
            'ten' => 'required',
            'gia' => 'required'
        ], [
            'ma_tu.required' => 'Vui lòng nhập mã tủ.',
            'ma_tu.unique' => 'Mã tủ đã tồn tại trong cơ sở dữ liệu.',
            'ten.required' => 'Vui lòng nhập tên tủ.',
            'gia.required' => 'Vui lòng nhập giá.',
        ]);

        $this->TuRepository->create([
            'ma_tu' => $request->ma_tu,
            'ten' => $request->ten,
            'gia' => $request->gia
        ]);

        session()->flash('success', 'Tủ đã được thêm thành công.');
        return redirect()->route('category.index');
    }

    public function edit($id)
    {
        try {
            $phanLoai = $this->TuRepository->find($id);
            return view('admin.category.edit_tu', [
                'tu' => $phanLoai
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            session()->flash('error', 'ID không tồn tại.');
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        $phanLoai = $this->TuRepository->find($id);

        $request->validate([
            'ma_tu' => 'required|unique:phan_loai,ma_tu,' . $id . ',id',
            'ten' => 'required',
            'gia' => 'required'
        ], [
            'ma_tu.required' => 'Vui lòng nhập mã tủ.',
            'ma_tu.unique' => 'Mã tủ đã tồn tại trong cơ sở dữ liệu.',
            'ten.required' => 'Vui lòng nhập tên tủ.',
            'gia.required' => 'Vui lòng nhập giá.',
        ]);

        $this->TuRepository->update($id, [
            'ma_tu' => $request->ma_tu,
            'ten' => $request->ten,
            'gia' => $request->gia
        ]);

        session()->flash('success', 'Tủ đã được cập nhật thành công.');
        return redirect()->route('category.index', $phanLoai);
    }

    public function destroy($id)
    {
        try {
            $this->TuRepository->delete($id);

            session()->flash('success', 'Tủ đã được xóa thành công.');
            return redirect()->route('category.index');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            session()->flash('error', 'ID không tồn tại.');
            return redirect()->back();
        }
    }

    public function storeAPI(Request $request)
    {
        $request->validate([
            'ma_tu' => [
                'required',
                Rule::unique('phan_loai')->where(function ($query) use ($request) {
                    return $query->where('ma_tu', $request->ma_tu);
                }),
            ],
            'ten' => 'required',
            'gia' => 'required'
        ], [
            'ma_tu.required' => 'Vui lòng nhập mã tủ.',
            'ma_tu.unique' => 'Mã tủ đã tồn tại trong cơ sở dữ liệu.',
            'ten.required' => 'Vui lòng nhập tên tủ.',
            'gia.required' => 'Vui lòng nhập giá.',
        ]);

        $this->TuRepository->create([
            'ma_tu' => $request->ma_tu,
            'ten' => $request->ten,
            'gia' => $request->gia
        ]);

        return response()->json(['success' => 'Tủ đã được thêm thành công.', 'Phan Loai' => $tu], 200);
    }

    public function updateAPI(Request $request, $id)
    {
        $phanLoai = $this->TuRepository->find($id);

        $request->validate([
            'ma_tu' => 'required|unique:phan_loai,ma_tu,' . $id . ',id',
            'ten' => 'required',
            'gia' => 'required'
        ], [
            'ma_tu.required' => 'Vui lòng nhập mã tủ.',
            'ma_tu.unique' => 'Mã tủ đã tồn tại trong cơ sở dữ liệu.',
            'ten.required' => 'Vui lòng nhập tên tủ.',
            'gia.required' => 'Vui lòng nhập giá.',
        ]);

        $this->TuRepository->update($id, [
            'ma_tu' => $request->ma_tu,
            'ten' => $request->ten,
            'gia' => $request->gia
        ]);

        $this->TuRepository->update($id, $data);

        return response()->json(['success' => 'Tủ đã được cập nhật thành công.', 'phanLoai' => $phanLoai], 200);
    }

    public function destroyAPI($id)
    {
        try {
            $deleted = $this->TuRepository->delete($id);

            session()->flash('success', 'Tủ đã được xóa thành công.');

            if ($deleted) {
                return response()->json(['success' => 'Tủ đã được xoá thành công.', 'deleted' => $phanLoai], 200);
            } else {
                return response()->json(['error' => 'Không thể xoá tủ.'], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
