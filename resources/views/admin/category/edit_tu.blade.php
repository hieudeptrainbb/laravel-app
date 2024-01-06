@extends('admin.master')
@section('title', "Trang Chủ")
@section('title-page', "Quản lý phân loại tủ")
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
                        <a href="{{ route('category.add_tu') }}" class="btn btn-success">+Thêm tủ</a>

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
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <table class="table table-hover">
                            <form action="{{ route('category.update_tu', $tu) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="ma_tu">Mã Tủ</label>
                                    <input type="text" class="form-control" name="ma_tu" value="{{ $tu->ma_tu }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="ten">Tên</label>
                                    <input type="text" class="form-control" name="ten" value="{{ $tu->ten }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="gia">Giá</label>
                                    <input type="text" class="form-control" name="gia" value="{{ $tu->gia }}" required>
                                </div>

                                <button type="submit" class="btn btn-primary">Lưu</button>
                            </form>
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
