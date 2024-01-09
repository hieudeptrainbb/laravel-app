<?php

namespace App\Http\Controllers;

use App\Repositories\TuRepositoryInterface;
use App\Models\PhanloaiNgan;
use App\Models\PhanLoai;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PhanloaiNganController extends Controller
{
    private $tuRepository;

    public function __construct(TuRepositoryInterface $tuRepository)
    {
        $this->TuRepository = $tuRepository;
    }

    public function index()
    {
        //
        $phanloaiNgan = $this->TuRepository->allPhanLoaiNgan();

        return view('admin.category.add_phanloai_ngan', compact('phanloaiNgan'));
    }


    public function create()
    {
        //
        $phanloais = $this->TuRepository->allPhanLoaiNgan();

        return view('admin.category.index_phan_loai_ngan', compact('phanloais'));

    }


    public function store(Request $request)
    {
        $request->validate([
            'ten_ngan' => ['required',
                Rule::unique('phanloai_ngan')->where(function ($query) use ($request) {
                    return $query->where('phanloai_id', $request->phanloai_id);
                }),
            ],
            'phanloai_id' => 'required',
            'gia' => 'required'
        ], [
            'ten_ngan.required' => 'Vui lòng nhập tên ngăn',
            'ten_ngan.unique' => 'Tên phân loại ngăn đã tồn tại ',
            'phanloai_id.required' => 'Vui lòng nhập phân loại',
            'gia.required' => 'Vui lòng nhập giá'
        ]);


        $this->TuRepository->createPhanLoaiNgan([
            'ten_ngan' => $request->ten_ngan,
            'phanloai_id' => $request->phanloai_id,
            'ten_tu' => PhanLoai::where('id', $request->phanloai_id)->value('ma_tu'),
            'gia' => $request->gia
        ]);

        session()->flash('success', 'Thêm dữ liệu thành công.');
        return redirect()->route('category.index.phanloai');
    }


    public function edit($id)
    {
        try {
            $phanloaiNgan = $this->TuRepository->findPhanLoaiNgan($id);
            $phanloai = $this->TuRepository->all(); // Lấy danh sách phân loại

            return view('admin.category.edit_phanloai_ngan', compact('phanloaiNgan', 'phanloai'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            session()->flash('error', 'ID không tồn tại.');
            return redirect()->back();
        }
    }


    public function update(Request $request, $id)
    {
        $this->TuRepository->findPhanLoaiNgan($id);

        $request->validate([
            'ten_ngan' => ['required',
                Rule::unique('phanloai_ngan')->where(function ($query) use ($request) {
                    return $query->where('ten_tu', $request->ten_tu);
                }),
            ],
            'gia' => 'required'
        ], [
            'ten_ngan.required' => 'Vui lòng nhập tên ngăn',
            'ten_ngan.unique' => 'Tên phân loại ngăn đã tồn tại ',
            'gia.required' => 'Vui lòng nhập giá'
        ]);

        $data = $this->TuRepository->updatePhanLoaiNgan($id, [
            'ten_ngan' => $request->ten_ngan,
            'ten_tu' => $request->ten_tu,
            'gia' => $request->gia
        ]);

        return redirect()->route('category.index.phanloai')->with('success', 'Cập nhật dữ liệu thành công.');
    }


    public function destroy($id)
    {
        try {
            $phanloaiNgan = $this->TuRepository->deletePhanLoaiNgan($id);

            session()->flash('success', 'Xóa dữ liệu thành công.');
            return redirect()->route('category.index.phanloai');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            session()->flash('error', 'ID không tồn tại.');
            return redirect()->back();
        }
    }


    // ** *  API *** //

    public function storeAPI(Request $request)
    {
        $request->validate([
            'ten_ngan' => ['required',
                Rule::unique('phanloai_ngan')->where(function ($query) use ($request) {
                    return $query->where('phanloai_id', $request->phanloai_id);
                }),
            ],
            'phanloai_id' => 'required',
            'gia' => 'required'
        ], [
            'ten_ngan.required' => 'Vui lòng nhập tên ngăn',
            'ten_ngan.unique' => 'Tên phân loại ngăn đã tồn tại ',
            'phanloai_id.required' => 'Vui lòng nhập phân loại',
            'gia.required' => 'Vui lòng nhập giá'
        ]);


        $phanloaiNgan = $this->TuRepository->createPhanLoaiNgan([
            'ten_ngan' => $request->ten_ngan,
            'phanloai_id' => $request->phanloai_id,
            'ten_tu' => PhanLoai::where('id', $request->phanloai_id)->value('ma_tu'),
            'gia' => $request->gia
        ]);

        return response()->json(['success' => 'Thêm thành công.', 'Phan Loai Ngan' => $phanloaiNgan], 200);


    }

    public function updateAPI(Request $request, $id)
    {

        $request->validate([
            'ten_ngan' => ['required',
                Rule::unique('phanloai_ngan')->where(function ($query) use ($request) {
                    return $query->where('ten_tu', $request->ten_tu);
                }),
            ],
            'gia' => 'required'
        ], [
            'ten_ngan.required' => 'Vui lòng nhập tên ngăn',
            'ten_ngan.unique' => 'Tên phân loại ngăn đã tồn tại ',
            'gia.required' => 'Vui lòng nhập giá'
        ]);

        $phanloaiNgan = $this->TuRepository->updatePhanLoaiNgan($id, [
            'ten_ngan' => $request->ten_ngan,
            'ten_tu' => $request->ten_tu,
            'gia' => $request->gia
        ]);

        return response()->json(['success', 'Cập nhật dữ liệu thành công.', 'Sua Phan Loai Ngan' => $phanloaiNgan], 200);
    }

    public function destroyAPI($id)
    {
        try {
            $phanloaiNgan = $this->TuRepository->findPhanLoaiNgan($id);
            $deleted = $this->TuRepository->deletePhanLoaiNgan($id);

            if ($deleted) {
                return response()->json(['success' => 'Xóa dữ liệu thành công.', 'Xoa Phan Loai Ngan' => $phanloaiNgan], 200);
            } else {
                return response()->json(['error' => 'Không thể xóa dữ liệu.'], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
