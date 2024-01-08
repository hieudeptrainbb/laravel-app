@extends('admin.master')
@section('title', "Quản lý phân loại ngăn")
@section('title-page', "Quản lý phân loại ngăn")
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
                        <a href="{{ route('phanloai_ngan.index') }}" class="btn btn-success">+Thêm phân loại ngăn</a>

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
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>Mã Tủ</th>
                                <th>Tên</th>
                                <th>Giá</th>
                                <th>Thao Tác</th>
                            </tr>
                            @foreach ($phanloais as $tu)
                                <tr>
                                    <td>{{ $tu->ten_tu }} - {{ $tu->phanLoai->ten }}</td>
                                    <td>{{ $tu->ten_ngan }}</td>
                                    <td>{{ $tu->gia }}</td>
                                    <td>
                                        <a href="{{ route('category.edit.phanloai', $tu->id) }}" class="btn btn-success" style="display: inline-block; margin-right: 10px;">Sửa</a>
                                        <form action="{{ route('category.delete_phan_loai_ngan', $tu->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
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
