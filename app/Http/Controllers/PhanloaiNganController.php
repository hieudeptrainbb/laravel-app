<?php

namespace App\Http\Controllers;

use App\Models\PhanloaiNgan;
use App\Models\PhanLoai;
use Illuminate\Http\Request;

class PhanloaiNganController extends Controller
{

    public function index()
    {
        //
        $phanloaiNgan = PhanLoai::all();

        return view('admin.category.add_phanloai_ngan', compact('phanloaiNgan'));
    }


    public function getTenTu($id)
    {

    }


    public function create()
    {
        //
        $phanloais = PhanloaiNgan::all();

        return view('admin.category.index_phan_loai_ngan', compact('phanloais'));

    }


    public function store(Request $request)
    {
        $tenNgan = $request->ten_ngan;
        $phanloaiId = $request->phanloai_id;
        $gia = $request->gia;

        $existingNgan = PhanloaiNgan::where('ten_ngan', $tenNgan)
            ->where('phanloai_id', $phanloaiId)
            ->first();

        if ($existingNgan) {
            // Dữ liệu đã tồn tại
            session()->flash('error', 'Dữ liệu đã tồn tại.');
            return redirect()->route('phanloai_ngan.index');
        }

        $phanloaiNgan = new PhanloaiNgan();
        $phanloaiNgan->ten_ngan = $request->ten_ngan;
        $phanloaiNgan->phanloai_id = $request->phanloai_id;
        $phanloaiNgan->ten_tu = PhanLoai::where('id', $request->phanloai_id)->value('ma_tu');
        $phanloaiNgan->gia = $request->gia;
        $phanloaiNgan->save();

            session()->flash('success', 'Thêm dữ liệu thành công.');
            return redirect()->route('category.index.phanloai');


    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $phanloaiNgan = PhanloaiNgan::findOrFail($id);
        $phanloai = PhanLoai::all(); // Lấy danh sách phân loại

        return view('admin.category.edit_phanloai_ngan', compact('phanloaiNgan', 'phanloai'));
    }


    public function update(Request $request, $id)
    {
        $tenNgan = $request->ten_ngan;
        $tenTu = $request->ten_tu;
        $gia = $request->gia;

        $existingNgan = PhanloaiNgan::where('ten_ngan', $tenNgan)
            ->where('ten_tu', $tenTu)
            ->where('id', '!=', $id) // Loại trừ bản ghi đang được chỉnh sửa
            ->first();

        if ($existingNgan) {
            // Dữ liệu đã tồn tại
            return back()->with('error', 'Dữ liệu đã tồn tại.');
        }

        $phanloaiNgan = PhanloaiNgan::findOrFail($id);
        $phanloaiNgan->ten_ngan = $tenNgan;
        $phanloaiNgan->ten_tu = $tenTu;
        $phanloaiNgan->gia = $gia;
        $phanloaiNgan->save();

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
        $tenNgan = $request->ten_ngan;
        $phanloaiId = $request->phanloai_id;
        $gia = $request->gia;

        $existingNgan = PhanloaiNgan::where('ten_ngan', $tenNgan)
            ->where('phanloai_id', $phanloaiId)
            ->first();

        if ($existingNgan) {
            return response()->json(['error' => 'Mã tủ đã tồn tại trong cơ sở dữ liệu.'], 400);
        }

        $phanloaiNgan = new PhanloaiNgan();
        $phanloaiNgan->ten_ngan = $request->ten_ngan;
        $phanloaiNgan->phanloai_id = $request->phanloai_id;
        $phanloaiNgan->ten_tu = PhanLoai::where('id', $request->phanloai_id)->value('ma_tu');
        $phanloaiNgan->gia = $request->gia;
        $phanloaiNgan->save();

        return response()->json(['success' => 'Thêm thành công.','Phan Loai Ngan' => $phanloaiNgan], 200);


    }

    public function updateAPI(Request $request, $id)
    {
        $tenNgan = $request->ten_ngan;
        $tenTu = $request->ten_tu;
        $gia = $request->gia;

        $existingNgan = PhanloaiNgan::where('ten_ngan', $tenNgan)
            ->where('ten_tu', $tenTu)
            ->where('id', '!=', $id) // Loại trừ bản ghi đang được chỉnh sửa
            ->first();

        if ($existingNgan) {
            // Dữ liệu đã tồn tại
            return response()->json(['error', 'Dữ liệu đã tồn tại.'], 400);
        }

        $phanloaiNgan = PhanloaiNgan::findOrFail($id);
        $phanloaiNgan->ten_ngan = $tenNgan;
        $phanloaiNgan->ten_tu = $tenTu;
        $phanloaiNgan->gia = $gia;
        $phanloaiNgan->save();

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
