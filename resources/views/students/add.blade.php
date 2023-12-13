@extends('admin.master')
@section('title',"Trang Chu")
@section('title-page',"Quan ly bai viet")
@section('main-content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Quản lý menu trang giao diện
       
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
     <div class="col-md-8">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Thêm mới menu</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Tên Menu</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Giới thiệu">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Chọn Menu Cha</label>
                  <select name="" id="input" class="form-control" required="required">
                    <option value="">Chọn danh Menu cha</option>
                    <option value="">Học bổng</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Chọn Vị trí</label>
                  <select name="" id="input" class="form-control" required="required">
                    <option value="">Chọn vị trí</option>
                    <option value="">1</option>
                    <option value="">2</option>
                    <option value="">3</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Chọn trạng thái</label>
                  <div class="radio">
                    <label>
                      <input type="radio" name="" id="input" value="" checked="checked">
                      Hiện
                    </label>
                    <label>
                      <input type="radio" name="" id="input" value="" >
                      Ẩn
                    </label>
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

        </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
@endsection   

      