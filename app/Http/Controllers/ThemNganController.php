<?php

namespace App\Http\Controllers;

use App\Models\Ngan;
use App\Models\PhanLoai;
use App\Models\PhanloaiNgan;
use Illuminate\Http\Request;

class ThemNganController extends Controller
{

    public function index() {

        //
        $phanLoais = PhanloaiNgan::all();

        return view('admin.category.add_ngan', compact('phanLoais'));
    }
    public function getPhanLoai(Request $request) {
        $phanloai_ngan =  PhanloaiNgan::query()->find($request->selectedPhanLoaiID);

        return response()->json([
            'status' => 200,
            'message' => 'Tra du lieu thanh cong',
            'data' => $phanloai_ngan->toArray()
        ], 200);

//        return view('admin.category.add_ngan', compact('phanloai_ngan'))->render(); // Trả về partial view chứa dữ liệu
    }


    public function create()
    {
        $ngans = Ngan::all();

        return view('admin.category.index_ngan', compact('ngans'));
    }

    public function store(Request $request)
    {

        //Kiem tra ten ngan co hay chua
        $kiemtraNgan = Ngan::where('phanloai_id', $request->phanloai_id)
        ->where('ten_ngan', $request->ten_ngan)->first();
        if($kiemtraNgan) {
            session()->flash('error', 'Phân loại hoặc Tên ngăn đã tồn tại');
            return redirect()->route('category.add_ngan');
        }
        $ngan = new Ngan();
        $phanloai_ngan = PhanloaiNgan::query()->find($request->phanloai_ngan);
        $ngan->ten_ngan = $request->ten_ngan;
        $ngan->phanloai_ngan = $phanloai_ngan->ten_ngan;
        $ngan->phanloai_id =  $phanloai_ngan->phanloai_id;
        $ngan->phanloai_ngan_id = $request->phanloai_ngan;
        $ngan->trang_thai = $request->trang_thai;
        $ngan->save();

        session()->flash('success', 'Thêm dữ liệu thành công.');
        // Chuyển hướng người dùng đến trang danh sách
        return redirect()->route('category.index_ngan');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $ngan = Ngan::findOrFail($id);
        $phanLoais = PhanloaiNgan::all();

        return view('admin.category.edit_ngan', compact('ngan', 'phanLoais'));
    }

    public function update(Request $request, $id)
    {
        $ngan = Ngan::findOrFail($id);

        // Kiểm tra nếu ngăn đã tồn tại
        $kiemtraNgan = Ngan::where('phanloai_id', $request->phanloai_id)
            ->where('ten_ngan', $request->ten_ngan)
            ->where('id', '!=', $id)
            ->first();

        if ($kiemtraNgan) {
            return back()->with('error', 'Phân loại hoặc Tên ngăn đã tồn tại.');
        }

        $phanloai_ngan = PhanloaiNgan::query()->find($request->phanloai_ngan);

        $ngan->ten_ngan = $request->ten_ngan;
        $ngan->trang_thai = $request->trang_thai;
        $ngan->save();
        session()->flash('success', 'Cập nhật dữ liệu thành công.');
        return redirect()->route('category.index_ngan')->with('success', 'Cập nhật dữ liệu thành công.');
    }

    public function destroy($id)
    {
        $ngan = Ngan::findOrFail($id);
        $ngan->delete();

        return redirect()->route('category.index_ngan')->with('success', 'Xóa dữ liệu thành công.');
    }

    // *** API *** //

    public function storeAPI(Request $request)
    {

        //Kiem tra ten ngan co hay chua
        $kiemtraNgan = Ngan::where('phanloai_id', $request->phanloai_id)
            ->where('ten_ngan', $request->ten_ngan)->first();
        if($kiemtraNgan) {
            return response()->json(['error', 'Phân loại hoặc Tên ngăn đã tồn tại'], 400);
        }
        $ngan = new Ngan();
        $phanloai_ngan = PhanloaiNgan::query()->find($request->phanloai_ngan);
        $ngan->ten_ngan = $request->ten_ngan;
        $ngan->phanloai_ngan = $phanloai_ngan->ten_ngan;
        $ngan->phanloai_id =  $phanloai_ngan->phanloai_id;
        $ngan->phanloai_ngan_id = $request->phanloai_ngan;
        $ngan->trang_thai = $request->trang_thai;
        $ngan->save();

        return response()->json(['success', 'Thêm dữ liệu thành công.','Them Ngan' => $ngan], 200);
    }

    public function updateAPI(Request $request, $id)
    {
        $ngan = Ngan::findOrFail($id);

        // Kiểm tra nếu ngăn đã tồn tại
        $kiemtraNgan = Ngan::where('phanloai_id', $request->phanloai_id)
            ->where('ten_ngan', $request->ten_ngan)
            ->where('id', '!=', $id)
            ->first();

        if ($kiemtraNgan) {
            return response()->json(['error', 'Phân loại hoặc Tên ngăn đã tồn tại.'], 400);
        }

        $phanloai_ngan = PhanloaiNgan::query()->find($request->phanloai_ngan);

        $ngan->ten_ngan = $request->ten_ngan;
        $ngan->trang_thai = $request->trang_thai;
        $ngan->save();

        return response()->json(['success', 'Cập nhật dữ liệu thành công.', 'Sua Ngan' => $ngan], 200);
    }

    public function destroyAPI($id)
    {
        try {
            $ngan = Ngan::findOrFail($id);
            $deleted = $ngan->delete();

            if ($deleted) {
                return response()->json(['success' => 'Xóa dữ liệu thành công.', 'Xoa Ngan' => $ngan], 200);
            } else {
                return response()->json(['error' => 'Không thể xóa dữ liệu.'], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
