@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
<form action="{{ route('students.update', $student->id) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="form-group">
        <label for="student_code">Mã sinh viên</label>
        <input type="text" class="form-control" id="student_code" name="student_code" value="{{ $student->student_code }}">
    </div>

    <div class="form-group">
        <label for="name">Họ và tên</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $student->name }}">
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ $student->email }}">
    </div>

    <div class="form-group">
        <label for="birthdate">Ngày sinh</label>
        <input type="date" class="form-control" id="birthdate" name="birthdate" value="{{ $student->birthdate }}">
    </div>

    <button type="submit" class="btn btn-primary">Cập nhật</button>
</form>