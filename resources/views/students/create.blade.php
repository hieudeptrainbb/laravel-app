
@extends('students.layout')
@section('content')
    <h1>Thêm sinh viên</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('students.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="student_code">Mã sinh viên:</label>
            <input type="text" name="student_code" id="student_code" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="name">Họ và tên:</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="birthdate">Ngày sinh:</label>
            <input type="date" name="birthdate" id="birthdate" class="form-control" required>
        </div>
        


        <button type="submit" class="btn btn-primary">Thêm sinh viên</button>
    </form>
@endsection
