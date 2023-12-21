<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    
    public function profile()
    {
        $user = Auth::user();
        return view('auth.profile', ['user' => $user]);
    }

    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        
       
    if (Session::has('user_id')) {
        // Nếu có thông tin người dùng trong session, chuyển hướng đến trang chủ
        return redirect()->route('home');
    }

    // Nếu không có thông tin đăng nhập, hiển thị trang đăng nhập
    return view('auth.login');
    }

    public function showRegistrationForm()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('auth.register');
    }

    public function showLinkRequestForm()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('auth.passwords.email');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('student_code', 'password');

        if (Auth::attempt($credentials)) {
            // Đăng nhập thành công, chuyển hướng đến trang sau khi đăng nhập thành công
            $request->session()->regenerate(); // Tạo mới session để ngăn chặn tấn công session fixation

            // Lưu thông tin đăng nhập trong session
            $request->session()->put('user_id', Auth::user()->id);
            $request->session()->put('user_name', Auth::user()->name);

             // Tạo cookie chứa tên đăng nhập
             $username = Auth::user()->name;
             $password = Auth::user()->password;
             $id = Auth::user()->id;
             
             // Tạo các cookie riêng lẻ chứa thông tin của người dùng
             $cookie = cookie('user_id', $id, 600);


        // Trả về redirect response với cookie đã tạo
        return redirect()->intended('admin')->withCookie($cookie);
    } else {
        // Thông tin đăng nhập không chính xác, hiển thị thông báo lỗi
        return back()->withErrors([
            'login_error' => 'Mã sinh viên hoặc mật khẩu không chính xác!',
        ]);
    }
}

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function getSessions(Request $request)
{
    $allSessionValues = Session::all();
    $sessionId = session()->getId();
    
    // Lấy giá trị của một cookie cụ thể
    $specificCookieValue = $request->cookie('user_info');

    return dd([
        'allSessionValues' => $allSessionValues,
        'sessionId' => $sessionId,
        'specificCookieValue' => $specificCookieValue,
    ]);
}

// public function showCookieBySessionId()
// {
//     return view('cookie_form');
// }

// public function getCookieBySessionId(Request $request)
// {
//     $sessionId = $request->input('session_id');
//     $cookieData = [];

//     foreach ($request->cookies->all() as $key => $value) {
//         $cookieData[$key] = $request->cookie($key);
//     }

//     $specificCookieValue = null;

//     // Tìm specificCookieValue dựa trên sessionId
//     foreach ($cookieData as $key => $value) {
//         if ($value && $key === $sessionId) {
//             $specificCookieValue = $value;
//             break;
//         }
//     }

//     return view('cookie_info')->with('specificCookieValue', $specificCookieValue);
// }


 }