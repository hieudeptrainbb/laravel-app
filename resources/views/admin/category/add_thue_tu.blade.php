@extends('admin.master')
@section('title', 'Thuê tủ')
@section('title-page', 'Quản lý bài viết')
@section('main-content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Examples</a></li>
      <li class="active">Blank page</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Thuê tủ</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form method="POST" action="{{ route('thuetu.store') }}">
        @csrf

        <div class="box-body">
          <!-- Hiển thị thông báo lỗi -->
          @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif

          <!-- Hiển thị thông báo thành công -->
          @if(session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
          @endif

          @if(session('error'))
          <div class="alert alert-danger">
            {{ session('error') }}
          </div>
          @endif

          <div class="form-group">
            <label for="phanloai_id">Tủ</label>
            <select class="form-control" id="phanloai_id" name="phanloai_id">
                <option value="">-- Chọn tủ --</option> <!-- Option mặc định -->
                <!-- Lặp qua danh sách phân loại để tạo các option -->
                @foreach ($phanLoais as $phanLoai)
                    <option value="{{ $phanLoai->id }}">{{ $phanLoai->ten }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="ngang_id">Ngăn</label>
            <select class="form-control" id="ngang_id" name="ngang_id">
            </select>
        </div>

        <div class="form-group">
            <label for="ngay_gio_bat_dau">Ngày giờ bắt đầu</label>
            <input type="datetime-local" class="form-control" id="ngay_gio_bat_dau" name="ngay_gio_bat_dau">
        </div>

        <button type="submit" class="btn btn-primary">Thuê</button>
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#phanloai_id').on('change', function() {
            var phanLoaiId = $(this).val();

            // Gửi yêu cầu AJAX để lấy danh sách ngăn tương ứng với phân loại và trạng thái được chọn
            $.ajax({
                url: '/lay-danh-sach-ngan', // Thay thế đường dẫn với tuyến đường của bạn
                method: 'GET',
                data: { phanLoaiId: phanLoaiId, trangThai: 0 }, // Thêm trạng thái vào data
                success: function(ngans) {
                    $('#ngang_id').empty(); // Xóa các option cũ
                    // Thêm các option mới dựa trên dữ liệu trả về từ server
                    $.each(ngans, function(index, ngan) {
                        $('#ngang_id').append('<option value="' + ngan.id + '">' + ngan.ten_ngan + ' - ' + ngan.phanloai_ngan + '</option>');
                    });
                },
                error: function(err) {
                    console.error('Đã xảy ra lỗi: ', err);
                    // Xử lý lỗi nếu có
                }
            });
        });
    })
</script>


@endsection
