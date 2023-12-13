@extends('admin.master')
@section('title',"Trang Chu")
@section('title-page',"Quan ly bai viet")
@section('main-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        @yield('title-page')
       
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
           <a href="{{route('students.create')}}" class="btn btn-success">+Thêm mới danh mục</a>
           @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody><tr>
                  <th>Mã sinh viên</th>
                  <th>Họ và tên</th>
                  <th>Email</th>
                  <th>Ngày sinh</th>
                  <th>Hành động</th>
                </tr>
                <tr>
                  @foreach ($students as $student)
                  <td>{{ $student->student_code }}</td>
                  <td>{{ $student->name }}</td>
                  <td>{{ $student->email }}</td>
                  <td>{{ $student->birthdate }}</td>
                  <td>
                  <a href="{{ route('students.edit', $student->id) }}" class="btn btn-success">Sửa</a>
                  <form action="{{ route('students.destroy', $student->id) }}"  method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa sinh viên này?')">Xóa</button>
                </form>
                    
                  </td>
                </tr>
                @endforeach
              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
@endsection   

      