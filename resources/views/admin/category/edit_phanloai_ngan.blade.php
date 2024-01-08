
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
                            <form method="POST" action="{{ route('category.update_phan_loai_ngan', $phanloaiNgan->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="ten_tu">Ma Tu:</label>
                                    <input type="text" class="form-control" id="ten_tu" name="ten_tu" value="{{ $phanloaiNgan->ten_tu }}">
                                </div>

                                <div class="form-group">
                                    <label for="ten_ngan">Ten Ngan:</label>
                                    <input type="text" class="form-control" id="ten_ngan" name="ten_ngan" value="{{ $phanloaiNgan->ten_ngan }}">
                                </div>


                                <div class="form-group">
                                    <label for="gia">Gia:</label>
                                    <input type="text" class="form-control" id="gia" name="gia" value="{{ $phanloaiNgan->gia }}">
                                </div>

                                <button type="submit" class="btn btn-primary">Update</button>
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


