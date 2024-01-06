@extends('admin.master', ['pageID' => 'news'])
@section('title',"Trang Chu")
@section('main-content')
<p>ID người dùng: {{ request()->cookie('user_id') }}</p>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Thuê Tủ
          @csrf

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
           <a href="{{ route('thuetu.store') }}" class="btn btn-success">Thuê ngăn</a>

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
                  <tbody>
                  <tr>
                      <th>ID</th>
                      <th>Tên Tủ</th>
                      <th>Tên ngăn</th>
                      <th>Ngày giờ bắt đầu</th>
                      <th>Ngày giờ kết thúc</th>
                      <th>Tổng số giờ</th>
                      <th>Phân loại ngăn</th>
                      <th>Đơn giá</th>
                      <th>Thành tiền</th>
                      <th>Trạng thái</th>
                      <th>Tùy chọn</th>
                  </tr>
                  @foreach($thueTus as $thueTu)
                      <tr>
                          <td>{{ $thueTu->id }}</td>
                          <td>{{ $thueTu->phanLoai->ten }}</td>
                          <td>{{ $thueTu->ngan->ten_ngan }}</td>
                          <td>{{ $thueTu->ngay_gio_bat_dau }}</td>
                          <td>{{ $thueTu->ngay_gio_ket_thuc }}</td>
                          <td>{{ $thueTu->tong_so_gio }}</td>
                          <td>{{ $thueTu->ngan->phanloai_ngan }}</td>
                          <td>{{ $thueTu->don_gia }}</td>
                          <td>{{ $thueTu->thanh_tien }}</td>
                          <td>
                              @if ($thueTu->trang_thai == 'pending')
                                  <span class="label label-danger">Chưa Thanh Toán</span>
                              @else
                                  <span class="label label-success">Đã Thanh Toán</span>
                              @endif
                          </td>
                          <td>
                              <form method="POST" action="{{ route('thuetu.tratu', ['id' => $thueTu->id]) }}">
                                  @csrf
                                  @method('POST') <!-- Thêm dòng này để chỉ định phương thức POST -->
                                  <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn trả tủ?')">Trả tủ</button>
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

