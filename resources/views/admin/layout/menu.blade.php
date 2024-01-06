<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('assets')}}/images/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->

      <ul class="sidebar-menu" data-widget="tree">

{{--        <li>--}}
{{--          <a href="{{route('category.index')}}">--}}
{{--            <i class="fa fa-th"></i> <span>Quản lý Danh mục </span>--}}
{{--            <span class="pull-right-container">--}}
{{--              <small class="label pull-right bg-green">FE</small>--}}
{{--            </span>--}}
{{--          </a>--}}
{{--        </li>--}}






          <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Quản lý tủ</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('category.index') }}"><i class="fa fa-circle-o"></i>Quản lý tủ</a></li>
            <li><a href="{{ route('category.add_tu') }}"><i class="fa fa-circle-o"></i>Thêm tủ</a></li>
          </ul>
        </li>

          <li class="treeview">
              <a href="#">
                  <i class="fa fa-dashboard"></i> <span>Quản lý phân loại Ngăn</span>
                  <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
              </a>
              <ul class="treeview-menu">
                  <li><a href="{{ route('category.index.phanloai') }}"><i class="fa fa-circle-o"></i>Quản lý phân loại Ngăn</a></li>
                  <li><a href="{{ route('phanloai_ngan.index') }}"><i class="fa fa-circle-o"></i>Thêm phân loại Ngăn</a></li>
              </ul>
          </li>

          <li class="treeview">
              <a href="#">
                  <i class="fa fa-dashboard"></i> <span>Quản lý Ngăn</span>
                  <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
              </a>
              <ul class="treeview-menu">
                  <li><a href="{{ route('category.index_ngan') }}"><i class="fa fa-circle-o"></i>Quản lý Ngăn</a></li>
                  <li><a href="{{ route('category.add_ngan') }}"><i class="fa fa-circle-o"></i>Thêm  Ngăn</a></li>
              </ul>
          </li>

          <li class="treeview">
              <a href="#">
                  <i class="fa fa-dashboard"></i> <span>Thuê Tủ</span>
                  <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
              </a>
              <ul class="treeview-menu">
                  <li><a href="{{ route('thuetu.store') }}"><i class="fa fa-circle-o"></i>Thuê ngăn</a></li>
                  <li><a href="{{ route('category.thue_tu') }}"><i class="fa fa-circle-o"></i>Quản lý hành động Thuê Tủ</a></li>
              </ul>
          </li>


          <li class="treeview">
              <a href="#">
                  <i class="fa fa-dashboard"></i> <span>Quản lý Thuê Tủ</span>
                  <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
              </a>
              <ul class="treeview-menu">
                  <li><a href="{{ route('category.thue_tu') }}"><i class="fa fa-circle-o"></i>Quản lý, Thuê tủ</a></li>
                  <li><a href="{{ route('category.event') }}"><i class="fa fa-circle-o"></i>Quản lý hành động Thuê Tủ</a></li>
              </ul>
          </li>

    {{--        <li>--}}
    {{--          <a href="">--}}
    {{--            <i class="fa fa-th"></i> <span>Widgets</span>--}}
    {{--            <span class="pull-right-container">--}}
    {{--              <small class="label pull-right bg-green">Hot</small>--}}
    {{--            </span>--}}
    {{--          </a>--}}
    {{--        </li>--}}

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
