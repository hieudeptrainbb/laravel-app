<?php

namespace App\Http\Controllers;

use App\Models\Ngan;
use App\Models\PhanLoai;
use App\Models\PhanloaiNgan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ThemNganController extends Controller
{

    public function index()
    {

        //
        $phanLoais = PhanloaiNgan::all();

        return view('admin.category.add_ngan', compact('phanLoais'));
    }

    public function getPhanLoai(Request $request)
    {
        $phanloai_ngan = PhanloaiNgan::query()->find($request->selectedPhanLoaiID);

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
        $request->validate([
            'ten_ngan' => [
                'required',
                Rule::unique('ngan')->where(function ($query) use ($request) {
                    return $query->where('phanloai_ngan_id', $request->phanloai_ngan);
                }),
            ],
            'phanloai_ngan' => 'required',
            'phanloai_id' => 'required',
            'trang_thai' => 'required'
        ], [
            'ten_ngan.required' => 'Vui lòng nhập tên ngăn.',
            'ten_ngan.unique' => 'Tên ngăn đã tồn tại trong cơ sở dữ liệu.',
            'phanloai_ngan.required' => 'Vui lòng chọn phân loại.',
            'phanloai_id.required' => 'Vui lòng chọn phân loại ID.',
            'trang_thai.required' => 'Vui lòng chọn trạng thái.'
        ]);


        $phanloai_ngan = PhanloaiNgan::query()->find($request->phanloai_ngan);
        Ngan::create([
            'ten_ngan' => $request->ten_ngan,
            'phanloai_ngan' => $phanloai_ngan->ten_ngan,
            'phanloai_id' => $phanloai_ngan->phanloai_id,
            'phanloai_ngan_id' => $request->phanloai_ngan,
            'trang_thai' => $request->trang_thai
        ]);


        session()->flash('success', 'Thêm dữ liệu thành công.');
        // Chuyển hướng người dùng đến trang danh sách
        return redirect()->route('category.index_ngan');
    }

    public function edit($id)
    {
        try {
            $ngan = Ngan::findOrFail($id);
            $phanLoais = PhanloaiNgan::all();

            return view('admin.category.edit_ngan', compact('ngan', 'phanLoais'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            session()->flash('error', 'ID không tồn tại.');
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        $ngan = Ngan::findOrFail($id);
        $request->validate([
            'ten_ngan' => 'required|unique:ngan,ten_ngan,' . $id . ',id',

            'trang_thai' => 'required'
        ], [
            'ten_ngan.required' => 'Vui lòng nhập tên ngăn.',
            'ten_ngan.unique' => 'Tên ngăn đã tồn tại trong cơ sở dữ liệu.',
            'trang_thai.required' => 'Vui lòng chọn trạng thái.'
        ]);

        PhanloaiNgan::query()->find($request->phanloai_ngan);

        $ngan->update([
            'ten_ngan' => $request->ten_ngan,
            'trang_thai' => $request->trang_thai
        ]);
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
        $request->validate([
            'ten_ngan' => 'required',
            'phanloai_ngan' => 'required',
            'phanloai_id' => 'required',
            'trang_thai' => 'required'
        ], [
            'ten_ngan.required' => 'Vui lòng nhập tên ngăn',
            'phanloai_ngan.required' => 'Vui lòng chọn phân loại ',
            'phanloai_id.required' => 'Vui lòng chọn phân loại ID',
            'trang_thai.required' => 'Vui lòng chọn trạng thái'
        ]);

        //Kiem tra ten ngan co hay chua
        $kiemtraNgan = Ngan::where('phanloai_id', $request->phanloai_id)
            ->where('ten_ngan', $request->ten_ngan)->first();
        if ($kiemtraNgan) {
            return response()->json(['error', 'Phân loại hoặc Tên ngăn đã tồn tại'], 400);
        }

        $phanloai_ngan = PhanloaiNgan::query()->find($request->phanloai_ngan);
        $ngan = Ngan::create([
            'ten_ngan' => $request->ten_ngan,
            'phanloai_ngan' => $phanloai_ngan->ten_ngan,
            'phanloai_id' => $phanloai_ngan->phanloai_id,
            'phanloai_ngan_id' => $request->phanloai_ngan,
            'trang_thai' => $request->trang_thai
        ]);

        return response()->json(['success', 'Thêm dữ liệu thành công.', 'Them Ngan' => $ngan], 200);
    }

    public function updateAPI(Request $request, $id)
    {
        $ngan = Ngan::findOrFail($id);
        $request->validate([
            'ten_ngan' => 'required|unique:ngan,ten_ngan,' . $id . ',id',

            'trang_thai' => 'required'
        ], [
            'ten_ngan.required' => 'Vui lòng nhập tên ngăn.',
            'ten_ngan.unique' => 'Tên ngăn đã tồn tại trong cơ sở dữ liệu.',
            'trang_thai.required' => 'Vui lòng chọn trạng thái.'
        ]);

        PhanloaiNgan::query()->find($request->phanloai_ngan);

        $ngan->update([
            'ten_ngan' => $request->ten_ngan,
            'trang_thai' => $request->trang_thai
        ]);

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
