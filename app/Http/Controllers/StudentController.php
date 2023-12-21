<?php

namespace App\Http\Controllers;
    use App\Models\Student;
    use App\Models\GiangVien;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;

    use Illuminate\Support\Facades\Log;

    class StudentController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $students = Student::all();
            return view('students.index', compact('students'));
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            $giangvienOptions = GiangVien::pluck('giangvien_name', 'giangvien_id');
            return view('students.create')->with('giangvienOptions', $giangvienOptions);
            return view('students.create', compact('giangvienOptions'));
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
    {
            // Kiểm tra và xác thực dữ liệu từ yêu cầu
            $data = $request->validate([
                'student_code' => 'required|unique:student,student_code',
                'name' => 'required',
                'email' => 'required|email|unique:student,email',
                'birthdate' => 'required|date|before_or_equal:today',
                'giangvien_name' => 'required',
            ], [
                'student_code.unique' => 'Mã sinh viên đã tồn tại trong cơ sở dữ liệu.',
                'email.unique' => 'Địa chỉ email đã tồn tại trong cơ sở dữ liệu.',
                'birthdate.before_or_equal' => 'Ngày sinh không thể sau ngày hiện tại.',
            ]);

            // Tạo sinh viên mới và lưu vào cơ sở dữ liệu
            $student = Student::create($data);
           

            // Chuyển hướng người dùng đến trang danh sách sinh viên và hiển thị thông báo thành công
            return redirect()->route('students.index')->with('success', 'Cập nhật sinh viên thành công!');
    }

        /**
         * Display the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {
            //
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            //
            $student = Student::findOrFail($id);
            $giangvienOptions = GiangVien::pluck('giangvien_name', 'giangvien_id');
            return view('students.edit', compact('student', 'giangvienOptions'));
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, $id)
    {
        $request->validate([
            'student_code' => 'required|unique:student,student_code,'.$id,
            'name' => 'required',
            'email' => 'required|email|unique:student,email,'.$id,
            'birthdate' => 'required|date|before_or_equal:today',
            'giangvien_name' => 'required',
        ], [
            'student_code.unique' => 'Mã sinh viên đã tồn tại trong cơ sở dữ liệu.',
            'email.unique' => 'Địa chỉ email đã tồn tại trong cơ sở dữ liệu.',
            'birthdate.before_or_equal' => 'Ngày sinh không thể sau ngày hiện tại.',
        ]);

        $student = Student::findOrFail($id);
        $student->update($request->all());

        return redirect()->route('students.index')->with('success', 'Cập nhật sinh viên thành công!');
    }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            $student = Student::findOrFail($id);
            $student->delete();

            return redirect()->route('students.index')->with('success', 'Xóa sinh viên thành công!');
        }
    }
