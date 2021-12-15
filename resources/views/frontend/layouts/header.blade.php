<!-- Main Menu -->
<div class="bigshop-main-menu">
    <div class="container">
        <div class="classy-nav-container breakpoint-off">
            <nav class="classy-navbar" id="bigshopNav">

                <!-- Nav Brand -->
                <a href="{{ route('home') }}" class="nav-brand">
                    <img src="{{ get_setting('logo') }}" alt="logo">
                </a>

                <!-- Toggler -->
                <div class="classy-navbar-toggler">
                    <span class="navbarToggler"><span></span><span></span><span></span></span>
                </div>

                <!-- Menu -->
                <div class="classy-menu">
                    <!-- Close -->
                    <div class="classycloseIcon">
                        <div class="cross-wrap"><span class="top"></span><span
                                class="bottom"></span></div>
                    </div>

                    <!-- Nav -->
                    <div class="classynav">
                        <ul>
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('products') }}">Products</a></li>
                            <li><a href="javascript:void(0);">Blog</a></li>
                            <li><a href="{{ route('about') }}">About Us</a></li>
                            <li><a href="{{ route('contact') }}">Contact</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Hero Meta -->
                <div class="hero_meta_area ml-auto d-flex align-items-center justify-content-end">
                    <!-- Search -->
                    <div class="search-area">
                        <div class="search-btn"><i class="icofont-search"></i></div>
                        <!-- Form -->
                        <form action="{{ route('search') }}" method="GET">
                            <div class="search-form d-flex">
                                <input type="search" id="search-text" name="query" class="form-control" placeholder="Search">
                                <input type="submit" class="d-none" value="Send">
                            </div>
                        </form>
                    </div>

                    <!-- Wishlist -->
                    <div class="cart-area">
                        <div class="cart--btn">
                            <a href="{{ route('wishlist') }}" class="wishlist-btn">
                                <i class="icofont-heart"></i>
                                <span class="cart_quantity" id="wishlist-counter">{{ Cart::instance('wishlist')->count() }}</span>
                            </a>
                        </div>
                    </div>

                    <!-- Cart -->
                    <div class="cart-area">
                        <div class="cart--btn">
                            <i class="icofont-cart"></i>
                            <span class="cart_quantity"
                                id="cart-counter">{{ Cart::instance('shopping')->count() }}</span>
                        </div>

                        <!-- Cart Dropdown Content -->
                        <div class="cart-dropdown-content">
                            <ul class="cart-list">
                                @forelse (Cart::instance('shopping')->content() as $item)
                                    <li>
                                        <div class="cart-item-desc">
                                            <a href="#" class="image">
                                                <img src="{{ $item->model->photo }}" class="cart-thumb" alt=""
                                                    style="width: 30px;">
                                            </a>
                                            <div>
                                                <a
                                                    href="{{ route('product.details', $item->model->slug) }}">{{ $item->name }}</a>
                                                <p>{{ $item->qty }} x - <span
                                                        class="price">${{ number_format($item->price, 2) }}</span>
                                                </p>
                                            </div>
                                        </div>
                                        <span class="dropdown-product-remove cart_delete"
                                            data-id="{{ $item->rowId }}"><i class="icofont-bin"></i></span>
                                    </li>
                                @empty
                                    <p>No product</p>
                                @endforelse

                            </ul>
                            <div class="cart-pricing my-4">
                                <ul>
                                    <li>
                                        <span>Sub Total:</span>
                                        <span>${{ Cart::subtotal() }}</span>
                                    </li>
                                    <li>
                                        <span>Total:</span>
                                        @php
                                            $subtotal = floatval(implode(explode(',',Cart::subtotal())));
                                        @endphp
                                        @if (session()->has('coupon'))
                                            <span>${{ number_format($subtotal - session()->get('coupon')['value'], 2)  }}</span>
                                        @else
                                            <span>${{ Cart::subtotal() }}</span>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                            <div class="cart-box">
                                <a href="{{ route('cart') }}" class="btn btn-primary btn-sm d-block">Cart</a>
                            </div>
                            <div class="cart-box mt-2">
                                <a href="{{ route('checkout.one') }}" class="btn btn-primary btn-sm d-block {{ Cart::instance('shopping')->count() > 0 ? '' : 'disabled'}}">Checkout</a>
                            </div>
                        </div>
                    </div>

                    <!-- Account -->
                    <div class="account-area">
                        @auth
                            <div class="user-thumbnail">
                                @if (auth()->user()->photo)
                                    <img src="{{ Auth::user()->photo }}" alt="">
                                @else
                                    <img src="{{ Helper::userDefaultImage() }}" alt="">
                                @endif
                            </div>
                        @else
                            <div class="user-thumbnail">
                                <i class="icofont-user"></i>
                            </div>
                        @endauth

                        <ul class="user-meta-dropdown">
                            @auth
                                @php
                                    $first_name = explode(' ', auth()->user()->full_name);
                                @endphp
                                <li class="user-title"><span>Hello,</span> {{ $first_name[0] }}!</li>
                                <li><a href="{{ route('user.dashboard') }}">My Account</a></li>
                                <li><a href="{{ route('user.order') }}">Orders List</a></li>
                                <li>
                                    <a href="{{ route('user.auth.logout') }}"><i class="icofont-logout"></i>
                                        Logout</a>
                                </li>
                            @else
                                <li><a href="{{ route('user.auth.login') }}">Login</a></li>
                                <li><a href="{{ route('user.auth.register') }}">Register</a></li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
