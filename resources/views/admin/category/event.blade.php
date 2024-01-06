@extends('admin.master')
@section('title', "Hành động tủ")
@section('title-page', "Trạng thái tủ")
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
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th style="width: 5%">ID</th>
                                <th style="text-align: center; width: 20%">Tủ</th>
                                <th style="text-align: center; width: 10%">Phân loại ngăn</th>
                                <th style="text-align: center; width: 10%">Ngăn</th>
                                <th style="text-align: center; width: 20%">Ngày thuê</th>
                                <th style="text-align: center; width: 20%">Ngày trả tủ</th>
                                <th style="text-align: center; width: 30%">Trạng thái</th>
                            </tr>
                            @foreach($events as $event)
                            <tr>
                                <td>{{ $event->id }}</td>
                                <td style="text-align: center">{{ $event->phanLoai->ten ?? '' }}</td>
                                <td style="text-align: center">{{ $event->nganTu->phanloai_ngan ?? '' }}</td>
                                <td style="text-align: center">{{ $event->ngan }}</td>
                                <td style="text-align: center">{{ $event->created_at }}</td>
                                <td style="text-align: center">{{ $event->updated_at }}</td>
                                <td style="text-align: center">
                                    @if ($event->action == 'thuê tủ')
                                        <span class="label label-danger ">Thuê tủ</span>
                                    @else
                                        <span class="label label-success">Trả tủ</span>
                                    @endif
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
