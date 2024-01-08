@extends('admin.master')
@section('title', 'Thêm tủ')
@section('title-page', 'Quản lý bài viết')
@section('main-content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Thêm Tủ
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
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Thêm mới tủ</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="POST" action="{{ route('category.add_tu') }}">
                    @csrf
                    <div class="box-body">

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
                            <label for="ma_tu">Mã Tủ</label>
                            <div class="">
                                <input id="ma_tu" type="text" class="form-control @error('ma_tu') is-invalid @enderror"
                                       name="ma_tu">
                                @error('ma_tu')
                                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ten">Tên Tủ</label>
                            <div class="">
                                <input id="ten" type="text" class="form-control @error('ten') is-invalid @enderror"
                                       name="ten">
                                @error('ten')
                                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="gia">Giá</label>
                            <div class="">
                                <input id="gia" type="text" class="form-control @error('gia') is-invalid @enderror"
                                       name="gia">
                                @error('gia')
                                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Thêm mới</button>
                    </div>
                </form>
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
@endsection
