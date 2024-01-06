<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ngan;
use App\Models\PhanLoai;
use App\Models\PhanloaiNgan;
use App\Models\ThueTu;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ThueTuController extends Controller
{

    public function thueTu()  {
    $thueTus = \App\Models\ThueTu::all();
    $ngans = \App\Models\Ngan::all();

    return view('admin.category.thue_tu', compact('thueTus','ngans'));
    }

    public function indexTu()  {
        $thueTus = \App\Models\ThueTu::all();
        $ngans = \App\Models\Ngan::all();

        return view('admin.index', compact('thueTus','ngans'));
    }

    public function index()
    {
        $phanLoais = PhanLoai::all();
        $ngans = Ngan::all();


        return view('admin.category.add_thue_tu', ['phanLoais' => $phanLoais, 'ngans' => $ngans]);
    }

    public function layDanhSachNgan(Request $request)
    {
        $phanLoaiId = $request->get('phanLoaiId');
        $trangThai = $request->get('trangThai');

        // Xử lý logic để lấy danh sách ngăn tương ứng với phân loại và trạng thái
        // Ví dụ: Lấy danh sách ngăn có phân loại $phanLoaiId và trạng thái $trangThai
        $ngans = Ngan::where('phanloai_id', $phanLoaiId)
                    ->where('trang_thai', $trangThai)
                    ->get(['id', 'ten_ngan','phanloai_ngan']);

        return response()->json($ngans);
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $ngan = Ngan::query()
            ->where("id", $request->ngang_id)
            ->where("phanloai_id", $request->phanloai_id)
            ->first();

        if ($ngan && $ngan->trang_thai !== '1') {
            $phanLoaiNgan = PhanloaiNgan::find($ngan->phanloai_ngan_id);

            if ($phanLoaiNgan) {
                $ngayBatDau = Carbon::parse($request->ngay_gio_bat_dau);

                $thueTu = new ThueTu();
                $thueTu->phanloai_id = $request->phanloai_id;
                $thueTu->ngang_id = $request->ngang_id;
                $thueTu->ngay_gio_bat_dau = $request->ngay_gio_bat_dau;
                $thueTu->ngay_gio_ket_thuc = $request->ngay_gio_ket_thuc;
                $thueTu->tong_so_gio = 0;
                $thueTu->don_gia = $phanLoaiNgan->gia;
                $thueTu->thanh_tien = 0;
                $thueTu->trang_thai = 'pending';
                $thueTu->save();

                $ngan->trang_thai = '1';
                $ngan->save();

                $event = new Event();
                $event->phanloai_id = $request->phanloai_id;
                $event->ngan = $ngan->ten_ngan;
                $event->ngan_id = $ngan->id;
                $event->created_at = $request->ngay_gio_bat_dau;
                $event->updated_at = $request->ngay_gio_ket_thuc;
                $event->action = 'thuê tủ';
                $event->save();

                session()->flash('success', 'Đã tạo đơn thuê tủ thành công và cập nhật trạng thái ngăn.');
                return redirect()->route('category.thue_tu');
            } else {
                session()->flash('error', 'Không tìm thấy thông tin phân loại.');
                return redirect()->route('thuetu.store');
            }
        } else {
            session()->flash('error', 'Tủ này đã được thuê.');
            return redirect()->route('thuetu.store');
        }
    }


    public function tratu($id)
    {
        $thueTu = ThueTu::findOrFail($id);
        $ngayBatDau = $thueTu->ngay_gio_bat_dau; // Giả sử ngày giờ bắt đầu đã được truyền khi khởi tạo hàm

        if ($thueTu->trang_thai === 'pending') {
            $ngan = Ngan::findOrFail($thueTu->ngang_id);
            $ngan->trang_thai = '0';
            $ngan->save();

            $thueTu->ngay_gio_ket_thuc = Carbon::now(); // Sử dụng thời gian hiện tại làm thời gian kết thúc

            // Tính toán thành tiền dựa trên thời gian thuê và đơn giá
            $ngayKetThuc = Carbon::now('Asia/Ho_Chi_Minh');
            $tongSoGio = $ngayKetThuc->diffInHours($ngayBatDau);
            $thueTu->tong_so_gio = $tongSoGio;
            $thueTu->thanh_tien = $thueTu->tong_so_gio * $thueTu->don_gia;
            $thueTu->trang_thai = 'suss';
            $thueTu->save();

            $event = new Event();
            $event->phanloai_id = $thueTu->phanloai_id;
            $event->ngan = $ngan->ten_ngan; // Giả sử 'ten_ngan' là tên trường chứa tên ngăn trong bảng 'Ngan'
            $event->created_at = $ngayBatDau;
            $event->ngan_id = $ngan->id;
            $event->updated_at = Carbon::now();
            $event->action = 'trả tủ';
            $event->save();

            session()->flash('success', 'Đã trả tủ thành công.');
        } else {
            session()->flash('error', 'Tủ đã trả rồi.');
        }

        return redirect()->route('category.thue_tu');
    }




    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }


    // *** API *** //
    public function storeAPI(Request $request)
    {
        $ngan = Ngan::query()
            ->where("id", $request->ngang_id)
            ->where("phanloai_id", $request->phanloai_id)
            ->first();

        if ($ngan && $ngan->trang_thai !== '1') {
            $phanLoaiNgan = PhanloaiNgan::find($ngan->phanloai_ngan_id);

            if ($phanLoaiNgan) {
                $ngayBatDau = Carbon::parse($request->ngay_gio_bat_dau);

                $thueTu = new ThueTu();
                $thueTu->phanloai_id = $request->phanloai_id;
                $thueTu->ngang_id = $request->ngang_id;
                $thueTu->ngay_gio_bat_dau = $request->ngay_gio_bat_dau;
                $thueTu->ngay_gio_ket_thuc = $request->ngay_gio_ket_thuc;
                $thueTu->tong_so_gio = 0;
                $thueTu->don_gia = $phanLoaiNgan->gia;
                $thueTu->thanh_tien = 0;
                $thueTu->trang_thai = 'pending';
                $thueTu->save();

                $ngan->trang_thai = '1';
                $ngan->save();

                $event = new Event();
                $event->phanloai_id = $request->phanloai_id;
                $event->ngan = $ngan->ten_ngan;
                $event->created_at = $request->ngay_gio_bat_dau;
                $event->updated_at = $request->ngay_gio_ket_thuc;
                $event->action = 'thuê tủ';
                $event->save();

                return response()->json(['success', 'Đã tạo đơn thuê tủ thành công và cập nhật trạng thái ngăn.', 'Thue Ngan' => $thueTu],200);
            } else {
                return response()->json(['error', 'Không tìm thấy thông tin phân loại.'], 400);
            }
        } else {
            return response()->json(['error', 'Tủ này đã được thuê.'], 400);
        }
    }

    public function tratuAPI($id)
    {
        $thueTu = ThueTu::findOrFail($id);
        $ngayBatDau = $thueTu->ngay_gio_bat_dau; // Giả sử ngày giờ bắt đầu đã được truyền khi khởi tạo hàm

        if ($thueTu->trang_thai === 'pending') {
            $ngan = Ngan::findOrFail($thueTu->ngang_id);
            $ngan->trang_thai = '0';
            $ngan->save();

            $thueTu->ngay_gio_ket_thuc = Carbon::now(); // Sử dụng thời gian hiện tại làm thời gian kết thúc

            // Tính toán thành tiền dựa trên thời gian thuê và đơn giá
            $ngayKetThuc = Carbon::now('Asia/Ho_Chi_Minh');
            $tongSoGio = $ngayKetThuc->diffInHours($ngayBatDau);
            $thueTu->tong_so_gio = $tongSoGio;
            $thueTu->thanh_tien = $thueTu->tong_so_gio * $thueTu->don_gia;
            $thueTu->trang_thai = 'suss';
            $thueTu->save();

            $event = new Event();
            $event->phanloai_id = $thueTu->phanloai_id;
            $event->ngan = $ngan->ten_ngan; // Giả sử 'ten_ngan' là tên trường chứa tên ngăn trong bảng 'Ngan'
            $event->created_at = $ngayBatDau;
            $event->updated_at = Carbon::now();
            $event->action = 'trả tủ';
            $event->save();

            return response()->json(['success', 'Đã trả tủ thành công.', 'Tra Tu' => $thueTu], 200);
        } else {
            return response()->json(['error', 'Tủ đã trả rồi.'], 400);
        }
    }
}
