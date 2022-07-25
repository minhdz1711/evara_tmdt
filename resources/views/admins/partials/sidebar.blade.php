<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4 menu-open" style="display: block">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        @if(@$settings['website_logo']!="")
            <img src="{{ url(@$settings['website_logo']) }}" alt="{{ @$settings['website_name'] }}"
                 class=" brand-image img-circle elevation-3">
            <span class="brand-text font-weight-light">{{ @$settings['title_admin'] }}</span>
        @else
            <img src="{{ asset('/assets/dist/img/AdminLTELogo.png') }}" alt="{{ @$settings['website_name'] }}"
                 class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">{{ @$settings['title_admin'] }}</span>
        @endif
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                <!--dashboard-->
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link active">
                        <i class="nav-icon fa fa-tachometer"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <!--/end-->

                <!--post-->
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="nav-icon fa-thumb-tack fa"></i>
                        <p>Bài viết <i class="fa fa-angle-down right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.posts.index') }}" class="nav-link">
                                <i class="fa fa-angle-right  nav-icon"></i>
                                <p>Tất cả bài viết</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.posts.create') }}" class="nav-link">
                                <i class="fa fa-angle-right  nav-icon"></i>
                                <p>Thêm bài viết mới</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.post-categories.index') }}" class="nav-link">
                                <i class="fa fa-angle-right  nav-icon"></i>
                                <p>Danh mục bài viết</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!--/end post-->

                <!--product-->
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="nav-icon fa-motorcycle fa"></i>
                        <p>Sản phẩm <i class="fa fa-angle-down right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.products.index') }}" class="nav-link">
                                <i class="fa fa-angle-right  nav-icon"></i>
                                <p>Tất cả sản phẩm</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.products.create') }}" class="nav-link">
                                <i class="fa fa-angle-right  nav-icon"></i>
                                <p>Thêm sản phẩm mới</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.product-categories.index') }}" class="nav-link">
                                <i class="fa fa-angle-right  nav-icon"></i>
                                <p>Danh mục sản phẩm </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.brands.index') }}" class="nav-link">
                                <i class="fa fa-angle-right  nav-icon"></i>
                                <p>Thương hiệu sản phẩm </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.product-attributes.index') }}" class="nav-link">
                                <i class="fa fa-angle-right  nav-icon"></i>
                                <p>Thuộc tính sản phẩm </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!--/end product-->


{{--                <!--page-->--}}
{{--                <li class="nav-item has-treeview">--}}
{{--                    <a href="{{ route('admin.pages.index') }}" class="nav-link">--}}
{{--                        <i class="nav-icon fa fa-file" aria-hidden="true"></i>--}}
{{--                        <p>Trang</p>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <!--end-page-->--}}

                <!--product-->
                <li class="nav-item">
                    <a href="{{ route('admin.warehouse.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-shopping-cart"></i>
                        <p>Quản lý kho hàng </p>
                    </a>
                </li>
                <!--product-->

{{--                <!--order-->--}}
{{--                <li class="nav-item has-treeview">--}}
{{--                    <a href="{{ route('admin.orders.index') }}" class="nav-link">--}}
{{--                        <i class="nav-icon fa fa-archive" aria-hidden="true"></i>--}}
{{--                        <p>Quản lý đơn hàng <span class="badge badge-danger right">0</span></p>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <!--end-order-->--}}


                <!--theme-->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-paw"></i>
                        <p>Giao diện <i class="fa fa-angle-down right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="javascript:void(0);" class="nav-link">
                                <i class="fa fa-angle-right  nav-icon"></i>
                                <p>Menu <i class="fa fa-angle-down right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.menus.index') }}" class="nav-link">
                                        <i class="fa fa-angle-right  nav-icon"></i>
                                        <p>Tất cả menu</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.menu-positions.index') }}" class="nav-link">
                                        <i class="fa fa-angle-right  nav-icon"></i>
                                        <p>Vị trí menu</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.slides.index') }}" class="nav-link">
                                <i class="fa fa-angle-right  nav-icon"></i>
                                <p>Trình diễn ảnh</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.banners.index') }}" class="nav-link">
                                <i class="fa fa-angle-right  nav-icon"></i>
                                <p>Cấu hình banner</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!--/end theme-->

                <!--comment-->
                <li class="nav-item has-treeview">
                    <a href="{{ route('admin.comments.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-comments" aria-hidden="true"></i>
                        <p>Bình luận</p>
                    </a>
                </li>
                <!--end-comment-->

{{--                <!--payment-->--}}
{{--                <li class="nav-item has-treeview">--}}
{{--                    <a href="{{ route('admin.payments.index') }}" id="users" class="nav-link">--}}
{{--                        <i class="nav-icon fa fa-google-wallet"></i>--}}
{{--                        <p>Ví điện tử</p>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <!--end payment-->--}}


                <!--account-->
                <li class="nav-item has-treeview">
                    <a href="javascript:void(0)" id="users" class="nav-link">
                        <i class="nav-icon fa fa-users"></i>
                        <p>Tài khoản<i class="right fa fa-angle-down"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.users.index') }}" class="nav-link">
                                <i class="fa fa-angle-right  nav-icon"></i>
                                <p>Tài khoản quản trị</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.memberships.index') }}" class="nav-link">
                                <i class="fa fa-angle-right  nav-icon"></i>
                                <p>Tài khoản người dùng</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.roles.index') }}" class="nav-link">
                                <i class="fa fa-angle-right  nav-icon"></i>
                                <p>Phân quyền</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.users.logs') }}" class="nav-link">
                                <i class="fa fa-angle-right  nav-icon"></i>
                                <p>Lịch sử đăng nhập <i class="right fa fa-angle-down"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.users.logs') }}" class="nav-link">
                                        <i class="fa fa-angle-right  nav-icon"></i>
                                        <p>Lịch sử quản trị</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.memberships.logs') }}" class="nav-link">
                                        <i class="fa fa-angle-right  nav-icon"></i>
                                        <p>Lịch sử người dùng</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <!--end account-->

                <!--setting-->
                @if(\Auth::user()->can('setting-list'))
                    <li class="nav-item has-treeview">
                        <a href="javascript:void(0)" id="users" class="nav-link">
                            <i class="nav-icon fa fa-cog"></i>
                            <p>Cấu hình hệ thống<i class="right fa fa-angle-down"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.settings.index') }}" class="nav-link">
                                    <i class="fa fa-angle-right  nav-icon"></i>
                                    <p>Cài đặt</p>
                                </a>
                            </li>
                        </ul>
                    </li>
            @endif
            <!--end-setting-->
            </ul>
        </nav>
        <!-- /.sidebar menu -->
    </div>
</aside>
