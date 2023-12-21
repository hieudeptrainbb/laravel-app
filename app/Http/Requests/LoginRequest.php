<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'student_code' => 'required|string',
            'password' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'student_code.required' => 'Vui lòng nhập mã sinh viên.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
        ];
    }
    
}