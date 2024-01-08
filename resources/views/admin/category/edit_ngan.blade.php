

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
                            <form method="POST" action="{{ route('category.update_ngan', $ngan->id) }}">
                                @csrf
                                @method('PUT')



                                <div class="form-group row">
                                    <label for="ten_tu" class="col-md-4 col-form-label text-md-right">Tên tủ</label>
                                    <div class="col-md-6">
                                        <input id="ten_tu" type="text" class="form-control @error('ten_tu') is-invalid @enderror" name="ten_tu" value="{{ $ngan->phanLoaiNgan->ten_tu }}" required autocomplete="ten_tu" readonly>
                                        @error('ten_tu')
                                        <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="phanloai_ngan" class="col-md-4 col-form-label text-md-right">Phân loại ngăn</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="" value="{{ $ngan->phanLoaiNgan->ten_ngan }}" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="ten_ngan" class="col-md-4 col-form-label text-md-right">Tên ngăn</label>
                                    <div class="col-md-6">
                                        <input id="ten_ngan" type="text" class="form-control @error('ten_ngan') is-invalid @enderror" name="ten_ngan" value="{{ $ngan->ten_ngan }}" required autocomplete="ten_ngan" autofocus>
                                        @error('ten_ngan')
                                        <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="trang_thai" class="col-md-4 col-form-label text-md-right">Trạng thái</label>
                                    <div class="col-md-6">
                                        <select id="trang_thai" class="form-control @error('trang_thai') is-invalid @enderror" name="trang_thai" required>
                                            <option value="1" {{ $ngan->trang_thai == 1 ? 'selected' : '' }}>Hoạt động</option>
                                            <option value="0" {{ $ngan->trang_thai == 0 ? 'selected' : '' }}>Không hoạt động</option>
                                        </select>
                                        @error('trang_thai')
                                        <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4" style="text-align: right">
                                        <button type="submit" class="btn btn-primary"  >Cập nhật</button>
                                    </div>
                                </div>
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



