<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class DashBoardController extends Controller
{
    public function index()  {
        return view('admin.index');
    }
    public function thueTu()  {
         $thueTus = \App\Models\ThueTu::all();

    return view('admin.category.thue_tu', compact('thueTus'));
    }
    
}
