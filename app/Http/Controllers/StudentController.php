<?php

namespace App\Http\Controllers;
    use App\Models\Student;
    use App\Models\GiangVien;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
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
            /* ORM
            $students = Student::all();
            */

            dd(123);
            $students = DB::table('student')->get();

            return  $students;

//            return view('students.index', compact('students'));
        }

        public function test()
        {
            dd(123);

        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            $giangvienOptions = GiangVien::pluck('giangvien_name', 'giangvien_id');
            dd(1);
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
            $studentData = [
                'student_code' => $request->input('student_code'),
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'birthdate' => $request->input('birthdate'),
                'giangvien_name' => $request->input('giangvien_name'),
            ];

            // Tạo sinh viên mới và lưu vào cơ sở dữ liệu
//            $student = Student::create($data);
            // Tạo sinh viên mới và lưu vào cơ sở dữ liệu
            $studentId = DB::table('student')->insert($studentData);


            return  $studentId;
            // Chuyển hướng người dùng đến trang danh sách sinh viên và hiển thị thông báo thành công
//            return redirect()->route('students.index')->with('success', 'Cập nhật sinh viên thành công!');
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
            /*Elequent ORM
            $student = Student::findOrFail($id);
*/

//            Query Builder
            $student = DB::table('student')->where('id', $id)->first();

            // Lấy danh sách giảng viên từ bảng table_giangvien để tạo options cho select box
            $giangvienOptions = DB::table('table_giangvien')->pluck('giangvien_name');

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

        // Lấy dữ liệu từ request
        $studentData = [
            'student_code' => $request->input('student_code'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'birthdate' => $request->input('birthdate'),
            'giangvien_name' => $request->input('giangvien_name'),
        ];


        /* Elequent ORM

        $student = Student::findOrFail($id);
        $student->update($request->all());

        */
        // Cập nhật thông tin sinh viên trong bảng students

        DB::table('student')
                ->where('id', $id)
            ->update($studentData);

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
            /* ORM
            $student = Student::findOrFail($id);
            $student->delete();
            */
            // Xóa sinh viên từ bảng students
            $deleted = DB::table('student')->where('id', $id)->delete();

            return redirect()->route('students.index')->with('success', 'Xóa sinh viên thành công!');
        }
    }
