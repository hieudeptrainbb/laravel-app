<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Cabinet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RentalController extends Controller
{
    //
    public function store(Request $request)
    {
       $validator = Validator::make($request->all(), [
           'quantity' => 'required|integer',
           'cabinet_type' => 'required|string',
           'start_date' => 'required|date',
           'end_date' => 'required|date|after:start_date',
           'status' => 'required|string',
       ]);

       if ($validator->fails()) {
           return response()->json(['errors' => $validator->errors()], 400);
       }

       $cabinetId = $request->cabinet_id;
       // Tìm cabinet trong bảng cabinets với cabinet_id tương ứng
       $cabinet = Cabinet::find($cabinetId);

       if ($cabinet) {
        // Kiểm tra trạng thái của cabinet
        if ($cabinet->status == 0) {
            // Kiểm tra cabinet_id và cabinet_type
            $allowedCabinetTypes = [1, 2];
            if ($cabinet->id == $request->cabinet_id && $cabinet->type == $request->cabinet_type && in_array($request->cabinet_type, $allowedCabinetTypes)) {
                // Cập nhật trạng thái của cabinet thành 1 (đã thuê)
                $cabinet->status = 1;
                $cabinet->save();
    
                // Tiếp tục xử lý tạo bản ghi Rental
                $startTimestamp = strtotime($request->start_date);
                $endTimestamp = strtotime($request->end_date);
    
                $totalSeconds = $endTimestamp - $startTimestamp;
                $totalHours = $totalSeconds /3600;
    
                $rental = Rental::create([
                    'quantity' => $request->quantity,
                    'cabinet_id' => $request->cabinet_id,
                    'cabinet_type' => $request->cabinet_type,
                    'rental_price' => Cabinet::where('id', $request->cabinet_id)->whereIn('type', $allowedCabinetTypes)->value('price'),
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'total_hours' =>  $totalHours,
                    'status' => $request->status,
                    'user_id' => 1,
                ]);
    
                // Tiếp tục xử lý sau khi tạo bản ghi Rental nếu cần
    
            } else {
                // Xử lý khi cabinet_id hoặc cabinet_type không hợp lệ
                $data_return = [
                    'status' => 400,
                    'message' => 'Invalid cabinet id or type.'
                ];
                return response()->json($data_return);
            }
        } else {
            // Xử lý khi cabinet đã được thuê (status = 1)
            $data_return = [
                'status' => 400,
                'message' => 'Cabinet is already rented.'
            ];
            return response()->json($data_return);
        }
    } else {
        // Xử lý khi không tìm thấy cabinet với cabinet_id tương ứng
        $data_return = [
            'status' => 404,
            'message' => 'Cabinet not found.'
        ];
        return response()->json($data_return);
    }
        $data_return = [
            'rental' => $rental,
            'status'=>200,
            'message' => 'Rental created successfully'
        ];


        return response()->json($data_return);
    }

    
    public function getItems(Request $request)
    {
        // Lấy danh sách các mục đã thuê
        $rentals = Rental::where('status', 'rented')->get();

        return response()->json(['rentals' => $rentals], 200);
    }
}
