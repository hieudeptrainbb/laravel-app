<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
{
    if (Auth::check()) {
        return redirect()->route('home');
    }

    return view('auth.register');
}

    

    public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'birthdate' => 'required|date',
        'student_code' => 'required|string|max:255|unique:users',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'birthdate' => $request->birthdate,
        'student_code' => $request->student_code,
    ]);

    return redirect('/')->with('success', 'Đăng ký thành công!');
}
}