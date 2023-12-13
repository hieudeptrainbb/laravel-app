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
           <a href="{{route('category.add')}}" class="btn btn-success">+Thêm mới danh mục</a>
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
                  <<form action="{{ route('students.destroy', $student->id) }}" class="btn btn-danger" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa sinh viên này?')">Xóa</button>
                </form>
                    
                  </td>
                </tr>
                @endforeach
                <tr>
                  <td>Giới Thiệu</td>
                  <td>____</td>
                  <td>10-10-2018</td>
                  <td><span class="label label-success">Hiển thị</span></td>
                  <td>
                  <a href="" class="btn btn-success">Sửa</a>
                  <a href="" class="btn btn-danger">Xóa</a>
                    
                  </td>
                </tr>
                <tr>
                  <td>Đào tạo</td>
                  <td>____</td>
                  <td>10-10-2018</td>
                  <td><span class="label label-success">Hiển thị</span></td>
                  <td>
                  <a href="" class="btn btn-success">Sửa</a>
                  <a href="" class="btn btn-danger">Xóa</a>
                    
                  </td>
                </tr>
                <tr>
                  <td>Chương trình đào tạo</td>
                  <td>Đào tạo</td>
                  <td>10-10-2018</td>
                  <td><span class="label label-success">Hiển thị</span></td>
                  <td>
                  <a href="" class="btn btn-success">Sửa</a>
                  <a href="" class="btn btn-danger">Xóa</a>
                    
                  </td>
                </tr>
                <tr>
                  <td>Thi đua khen thưởng</td>
                  <td>Đào tạo</td>
                  <td>10-10-2018</td>
                  <td><span class="label label-danger">Đang ẩn</span></td>
                  <td>
                  <a href="" class="btn btn-success">Sửa</a>
                  <a href="" class="btn btn-danger">Xóa</a>
                    
                  </td>
                </tr>
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

      