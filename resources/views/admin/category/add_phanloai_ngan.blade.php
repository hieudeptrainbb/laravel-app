



@extends('admin.master')
@section('title', "Thêm phân loại ngăn")
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
                        <table class="table table-hover">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <form action="{{ route('phanloai_ngan.store') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="ten_ngan">Tên ngăn:</label>
                                    <input type="text" name="ten_ngan" id="ten_ngan" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="phanloai_id">Mã tủ:</label>
                                    <select name="phanloai_id" id="phanloai_id" class="form-control">
                                        <option value="">Chọn mã tủ</option>
                                        @foreach ($phanloaiNgan as $phanloai)
                                            <option value="{{ $phanloai->id }}">{{ $phanloai->ma_tu }} - {{ $phanloai->ten }} </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{--            <div class="form-group">--}}
                                {{--                <label for="ten_tu">Tên tủ:</label>--}}
                                {{--                <select name="ten_tu" id="ten_tu" class="form-control" disabled>--}}
                                {{--                    <option value="">Chọn mã tủ trước</option>--}}
                                {{--                </select>--}}
                                {{--            </div>--}}

                                <div class="form-group">
                                    <label for="gia">Giá:</label>
                                    <input type="text" name="gia" id="gia" class="form-control">
                                </div>

                                <button type="submit" class="btn btn-primary">Thêm</button>
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



