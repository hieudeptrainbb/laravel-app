<?php

namespace App\Http\Controllers;

use App\Models\Rental;
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
            'type' => $request->input('type'),
            'price' => $request->input('price'),
        ]);

        return response()->json(['message' => 'Cabinet created successfully']);
    }
}
