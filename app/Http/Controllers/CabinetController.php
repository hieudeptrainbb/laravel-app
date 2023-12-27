<?php

namespace App\Http\Controllers;

use App\Models\Cabinet;
use Illuminate\Http\Request;

class CabinetController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'price' => 'required|numeric',
        ]);

        $cabinet = Cabinet::create([
            'type' => $request->type,
            'status' => $request->status,
            'price' => $request->price,
        ]);

        return response()->json(['message' => 'Cabinet created successfully']);
    }
}
