<aside class="app-navbar">
    <!-- begin sidebar-nav -->
    <div class="sidebar-nav scrollbar scroll_dark">
        <ul class="metismenu " id="sidebarNav">
            <li class="nav-static-title">Menu</li>
            <li class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin') }}" aria-expanded="false">
                    <i class="nav-icon ti ti-layout-grid2"></i>
                    <span class="nav-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-static-title">Banner</li>
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i
                        class="nav-icon ti ti-layout-cta-right"></i><span class="nav-title">Banners
                        Management</span></a>
                <ul aria-expanded="false">
                    <li class="{{ request()->is('admin/banner') ? 'active' : '' }}"> <a
                            href='{{ route('banner.index') }}'>All Banners</a> </li>
                    <li class="{{ request()->is('admin/banner/create') ? 'active' : '' }}"> <a
                            href='{{ route('banner.create') }}'>Add Banners</a> </li>
                </ul>
            </li>
            <li class="nav-static-title">Shop</li>
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i
                        class="nav-icon ti ti-gallery"></i><span class="nav-title">Brands Management</span></a>
                <ul aria-expanded="false">
                    <li> <a href='{{ route('brand.index') }}'>All Brands</a> </li>
                    <li> <a href='{{ route('brand.create') }}'>Add Brands</a> </li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i
                        class="nav-icon dashicons dashicons-networking"></i><span class="nav-title">Categories
                        Management</span></a>
                <ul aria-expanded="false">
                    <li> <a href='{{ route('category.index') }}'>All Categories</a> </li>
                    <li> <a href='{{ route('category.create') }}'>Add Categories</a> </li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i
                        class="nav-icon ti ti-bag"></i><span class="nav-title">Products Management</span></a>
                <ul aria-expanded="false">
                    <li> <a href='{{ route('product.index') }}'>All Products</a> </li>
                    <li> <a href='{{ route('product.create') }}'>Add Products</a> </li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i
                        class="nav-icon ti ti-shopping-cart-full"></i><span class="nav-title">Carts
                        Management</span></a>
                <ul aria-expanded="false">
                    <li> <a href='calendar-full.html'>All Carts</a> </li>
                    <li> <a href='calendar-list.html'>Add Carts</a> </li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i
                        class="nav-icon ion ion-ios-checkmark-circle"></i><span class="nav-title">Coupon
                        Management</span></a>
                <ul aria-expanded="false">
                    <li> <a href='{{ route('coupon.index') }}'>All Coupons</a> </li>
                    <li> <a href='{{ route('coupon.create') }}'>Add Coupon</a> </li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i
                        class="nav-icon fa fa-truck"></i><span class="nav-title">Shipping
                        Management</span></a>
                <ul aria-expanded="false">
                    <li> <a href='{{ route('shipping.index') }}'>All Shippings</a> </li>
                    <li> <a href='{{ route('shipping.create') }}'>Add Shipping</a> </li>
                </ul>
            </li>
            {{--  --}}
            <li>
                <a href="{{ route('order.index') }}" aria-expanded="false">
                    <i class="nav-icon ti ti-layers-alt"></i>
                    <span class="nav-title">Order Management</span>
                </a>
            </li>
            <li class="nav-static-title">Post</li>
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i
                        class="nav-icon zmdi zmdi-folder"></i><span class="nav-title">Post Management</span></a>
                <ul aria-expanded="false">
                    <li> <a href='calendar-full.html'>All Post</a> </li>
                    <li> <a href='calendar-list.html'>Add Post</a> </li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i
                        class="nav-icon dashicons dashicons-networking"></i><span class="nav-title">Post
                        Categories</span></a>
                <ul aria-expanded="false">
                    <li> <a href='calendar-full.html'>All Post</a> </li>
                    <li> <a href='calendar-list.html'>Add Post</a> </li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i
                        class="nav-icon ti ti-tag"></i><span class="nav-title">Post Tags</span></a>
                <ul aria-expanded="false">
                    <li> <a href='calendar-full.html'>All Post</a> </li>
                    <li> <a href='calendar-list.html'>Add Post</a> </li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i
                        class="nav-icon ti ti-comments"></i><span class="nav-title">Comments Management</span></a>
                <ul aria-expanded="false">
                    <li> <a href='calendar-full.html'>All Comments</a> </li>
                    <li> <a href='calendar-list.html'>Add Comment</a> </li>
                </ul>
            </li>
            <li class="nav-static-title">Users</li>
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                <i class="nav-icon fa fa-group"></i><span class="nav-title">User Management</span></a>
                <ul aria-expanded="false">
                    <li> <a href='{{ route('user.index') }}'>All Users</a> </li>
                    <li> <a href='{{ route('user.create') }}'>Add User</a> </li>
                </ul>
            </li>
            <li class="nav-static-title">General Settings</li>
            <li>
                <a href="{{ route('settings') }}" aria-expanded="false">
                    <i class="nav-icon ti ti-settings"></i>
                    <span class="nav-title">Settings</span>
                </a>
            </li>
            <li class="nav-static-title">Others</li>
            <li>
                <a href="{{ route('settings.optimize') }}" aria-expanded="false">
                    <i class="nav-icon ti ti-brush"></i>
                    <span class="nav-title">Clear Cache</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- end sidebar-nav -->
</aside>
