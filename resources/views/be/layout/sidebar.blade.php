<!--**********************************
            Sidebar start
        ***********************************-->
<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            <li><a class="ai-icon" href="{{ route('admin.dashboard') }}" aria-expanded="false">
                    <i class="flaticon-381-networking"></i>
                    <span class="nav-text">Bảng điều khiển</span>
                </a>
            </li>
            @can('show-user')
                <li>
                    <a class="has-arrow ai-icon" href="javascript:void(0);" aria-expanded="false">
                        <i class="fas fa-users"></i>
                        <span class="nav-text">Quản lý người dùng</span>
                    </a>
                    <ul aria-expanded="false">
                        @can('show-user')
                            <li><a href="{{ route('users.index') }}">Danh sách người dùng</a></li>
                        @endcan
                        @can('show-role')
                            <li><a href="{{ route('roles.index') }}">Danh sách vai trò</a></li>
                        @endcan
                        @can('show-permission')
                            <li><a href="{{ route('permissions.index') }}">Danh sách quyền</a></li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('show-product')
                <li>
                    <a class="has-arrow ai-icon" href="javascript:void(0);" aria-expanded="false">
                        <i class="fab fa-product-hunt"></i>
                        <span class="nav-text">Quản lý sản phẩm</span>
                    </a>
                    <ul aria-expanded="false">
                        @can('show-brand')
                            <li><a href="{{ route('brands.index') }}">Danh sách thương hiệu</a></li>
                        @endcan
                        @can('show-product')
                                <li><a href="{{ route('products.index') }}">Danh sách sản phẩm</a></li>
                        @endcan
                        @can('show-category')
                            <li><a href="{{ route('categories.index') }}">Danh sách danh mục</a></li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('show-order')
                <li>
                    <a class="ai-icon" href="{{ route('orders.index') }}" aria-expanded="false">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="nav-text">Quản lý đơn hàng</span>
                    </a>
                </li>
            @endcan
            <li>
                <a class="ai-icon" href="{{ route('fe.home.index') }}" target="_blank">
                    <i class="flaticon-381-enter"></i>
                    <span class="nav-text">Xem trang web</span>
                </a>
            </li>

        </ul>
        <div class="copyright">
            <p>Bản quyền © {{ date('Y') }} Trương Quốc Vinh </p>
        </div>
    </div>
</div>
<!--**********************************
        Sidebar end
    ***********************************-->
