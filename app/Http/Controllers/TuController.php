<?php

namespace App\Http\Controllers;

use App\Models\PhanLoai;
use Illuminate\Http\Request;

class TuController extends Controller
{

    public function index()
    {
        $phanloais = PhanLoai::all();

        return view('admin.category.index_add_tu', ['phanloais' => $phanloais]);
    }


    public function create()
    {
        //
        $phanloais = PhanLoai::all();
        return view('admin.category.add_tu', ['phanloais' => $phanloais]);
    }

    public function store(Request $request)
    {
        // Kiểm tra xem "ma_tu" đã tồn tại trong cơ sở dữ liệu hay chưa
    $existingTu = PhanLoai::where('ma_tu', $request->ma_tu)->first();

    if ($existingTu) {
        session()->flash('error', 'Mã tủ đã tồn tại trong cơ sở dữ liệu.');
//        return response()->json(['error' => 'Mã tủ đã tồn tại trong cơ sở dữ liệu.'], 400);
        return redirect()->route('category.index')->with('error', 'Mã tủ đã tồn tại trong cơ sở dữ liệu.');
    }
        //
        $tu = new PhanLoai();
        $tu->ma_tu = $request->ma_tu;
        $tu->ten = $request->ten;
        $tu->gia = $request->gia;
        $tu->save();


        session()->flash('success', 'Tủ đã được thêm thành công.');
//        return response()->json(['success' => 'Tủ đã được thêm thành công.', 'route' => route('api.category.add_tu')], 200);
        return redirect()->route('category.index');
    }


    public function show(PhanLoai $phanLoai)
    {
        //
    }


    public function edit(PhanLoai $phanLoai)
    {
        return view('admin.category.edit_tu', ['tu' => $phanLoai]);
    }

    public function update(Request $request, PhanLoai $phanLoai)
    {
        // Kiểm tra xem "ma_tu" đã tồn tại trong cơ sở dữ liệu hay chưa (trừ tủ hiện tại)
        $existingTu = PhanLoai::where('ma_tu', $request->ma_tu)->where('id', '!=', $phanLoai->id)->first();

        if ($existingTu) {
            session()->flash('error', 'Mã tủ đã tồn tại trong cơ sở dữ liệu.');
            return redirect()->route('category.edit_tu', $phanLoai)->with('error', 'Mã tủ đã tồn tại trong cơ sở dữ liệu.');
        }

        $phanLoai->ma_tu = $request->ma_tu;
        $phanLoai->ten = $request->ten;
        $phanLoai->gia = $request->gia;
        $phanLoai->save();

        session()->flash('success', 'Tủ đã được cập nhật thành công.');
        return redirect()->route('category.index', $phanLoai);
    }

    public function destroy(PhanLoai $phanLoai)
    {
        $phanLoai->delete();

        session()->flash('success', 'Tủ đã được xóa thành công.');
        return redirect()->route('category.index');
    }

    public function storeAPI(Request $request)
    {
        // Kiểm tra xem "ma_tu" đã tồn tại trong cơ sở dữ liệu hay chưa
        $existingTu = PhanLoai::where('ma_tu', $request->ma_tu)->first();

        if ($existingTu) {
            session()->flash('error', 'Mã tủ đã tồn tại trong cơ sở dữ liệu.');
        return response()->json(['error' => 'Mã tủ đã tồn tại trong cơ sở dữ liệu.'], 400);

        }
        //
        $tu = new PhanLoai();
        $tu->ma_tu = $request->ma_tu;
        $tu->ten = $request->ten;
        $tu->gia = $request->gia;
        $tu->save();

        return response()->json(['success' => 'Tủ đã được thêm thành công.', 'Phan Loai'=> $tu], 200);
    }

    public function updateAPI(Request $request, PhanLoai $phanLoai)
    {
        // Kiểm tra xem "ma_tu" đã tồn tại trong cơ sở dữ liệu hay chưa (trừ tủ hiện tại)
        $existingTu = PhanLoai::where('ma_tu', $request->ma_tu)->where('id', '!=', $phanLoai->id)->first();

        if ($existingTu) {
            return response()->json(['error' => 'Mã tủ đã tồn tại trong cơ sở dữ liệu.'], 400);
        }

        $phanLoai->ma_tu = $request->ma_tu;
        $phanLoai->ten = $request->ten;
        $phanLoai->gia = $request->gia;
        $phanLoai->save();

        return response()->json(['success' => 'Tủ đã được cập nhật thành công.', 'phanLoai' => $phanLoai], 200);
    }

    public function destroyAPI(PhanLoai $phanLoai)
    {
        try {
            $deleted = $phanLoai->delete();

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
