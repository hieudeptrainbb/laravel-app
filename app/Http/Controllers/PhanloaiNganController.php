<?php

namespace App\Http\Controllers;


use App\Models\PhanloaiNgan;
use App\Models\PhanLoai;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PhanloaiNganController extends Controller
{

    public function index()
    {
        //
        $phanloaiNgan = PhanLoai::all();

        return view('admin.category.add_phanloai_ngan', compact('phanloaiNgan'));
    }


    public function create()
    {
        //
        $phanloais = PhanloaiNgan::all();

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


        PhanloaiNgan::create([
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
            $phanloaiNgan = PhanloaiNgan::findOrFail($id);
            $phanloai = PhanLoai::all(); // Lấy danh sách phân loại

            return view('admin.category.edit_phanloai_ngan', compact('phanloaiNgan', 'phanloai'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            session()->flash('error', 'ID không tồn tại.');
            return redirect()->back();
        }
    }


    public function update(Request $request, $id)
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

        $phanloaiNgan = PhanloaiNgan::findOrFail($id);
        $phanloaiNgan->update([
            'ten_ngan' => $request->ten_ngan,
            'ten_tu' => $request->ten_tu,
            'gia' => $request->gia
        ]);

        return redirect()->route('category.index.phanloai')->with('success', 'Cập nhật dữ liệu thành công.');
    }


    public function destroy($id)
    {
        $phanloaiNgan = PhanloaiNgan::findOrFail($id);
        $phanloaiNgan->delete();

        session()->flash('success', 'Xóa dữ liệu thành công.');
        return redirect()->route('category.index.phanloai');
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

        $phanloaiNgan = PhanloaiNgan::create([
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

        $phanloaiNgan = PhanloaiNgan::findOrFail($id);
        $phanloaiNgan->update([
            'ten_ngan' => $request->ten_ngan,
            'ten_tu' => $request->ten_tu,
            'gia' => $request->gia
        ]);

        return response()->json(['success', 'Cập nhật dữ liệu thành công.', 'Sua Phan Loai Ngan' => $phanloaiNgan], 200);
    }

    public function destroyAPI($id)
    {
        try {
            $phanloaiNgan = PhanloaiNgan::findOrFail($id);
            $deleted = $phanloaiNgan->delete();

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
