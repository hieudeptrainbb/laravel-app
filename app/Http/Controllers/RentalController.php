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
//        dd($request->all());
//        $validator = Validator::make($request->all(), [
//            'quantity' => 'required|integer',
//            'cabinet_type' => 'required|string',
//            'rental_price' => 'required|numeric',
//            'start_date' => 'required|date',
//            'end_date' => 'required|date|after:start_date',
//            'total_hours' => 'required|integer',
//            'status' => 'required|string',
//        ]);
//
//        if ($validator->fails()) {
//            return response()->json(['errors' => $validator->errors()], 400);
//        }
        $rental = Rental::create([
            'quantity' => $request->quantity,
            'cabinet_id' => $request->cabinet_id,
            'cabinet_type' => $request->cabinet_type,
            'rental_price' => $request->rental_price,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_hours' => $request->total_hours,
            'status' => $request->status,
            'user_id' => 1,
        ]);
        // Tạo một tủ mới
        $cabinet = Cabinet::create([
            'quantity' => $request->quantity,
            'type' => $request->type,
            'price' => $request->price,
        ]);

        $data_return = [
            'rental' => $rental,
            'status'=>200,
            'message' => 'Rental created successfully'
        ];

//        return response()->json(
//            ['message' => 'Rental created successfully', 'rental' => $rental],
//            ['message' => 'Cabinet created successfully', 'cabinet' => $cabinet] ,201);
        return response()->json($data_return);
    }

    public function getItems(Request $request)
    {
        // Lấy danh sách các mục đã thuê
        $rentals = Rental::where('status', 'rented')->get();

        return response()->json(['rentals' => $rentals], 200);
    }
}
