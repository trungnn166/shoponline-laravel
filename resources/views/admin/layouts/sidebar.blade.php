<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="{{Route::is('admin.dashboard') ? 'active' : ''}}" href="{{route('admin.dashboard')}}">
                        <i class="fa fa-dashboard"></i>
                        <span>Tổng quan</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;" class="{{Route::is('admin.categories.*') ? 'active' : ''}}">
                        <i class="fa fa-book"></i>
                        <span>Danh mục sản phẩm</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{ route('admin.categories.index') }}" class="{{Route::is('admin.categories.index') ? 'active' : ''}}">Danh sách</a></li>
                        <li><a href="{{ route('admin.categories.create') }}" class="{{Route::is('admin.categories.create') ? 'active' : ''}}">Thêm danh mục</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->