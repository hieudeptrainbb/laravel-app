@extends('admin.master')
@section('title', 'Thêm ngăn')
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
                    <h3 class="box-title">Thêm mới Ngăn</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="{{ route('category.add_ngan') }}" method="POST">
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
                            <label for="ten_ngan">Tên ngăn:</label>
                            <input type="text" name="ten_ngan" id="ten_ngan" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="phanloai_id">Phân loại ID:</label>
                            <select name="phanloai_id" id="phanloai_id" class="form-control" required>
                                <option value="">-- Chọn phân loại --</option> <!-- Option mặc định -->
                                @foreach($phanLoais as $phanLoai)
                                        <option value="{{ $phanLoai->id }}">{{ $phanLoai->ten_tu }}
                                        -{{ $phanLoai->phanloai_id }}    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="phanloai_ngan">Phân loại:</label>
                            <select name="phanloai_ngan" id="phanloai_ngan" class="form-control" required>
{{--                                @foreach($phanLoais as $phanLoai)--}}
{{--                                    <option value="{{ $phanLoai->id }}">{{ $phanLoai->ten_ngan }}   </option>--}}
{{--                                @endforeach--}}
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="trang_thai">Trạng thái:</label>
                            <select name="trang_thai" id="trang_thai" class="form-control" required>
                                <option value="0">Chưa thuê</option>
                            </select>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </div>
                </form>
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#phanloai_id').change(function () {
                var selectedPhanLoaiID = $(this).val();
                var data = {
                    "_token": "{{ csrf_token() }}",
                    "selectedPhanLoaiID": selectedPhanLoaiID
                }
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "{{ route('get.phanloai') }}",
                    data: data,
                    success: function (response) {
                        $('#phanloai_ngan').empty(); // Xóa các option cũ
                        $('#phanloai_ngan').append('<option value="' + response.data.id + '">' + response.data.ten_ngan + '</option>');

                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>
@endsection
