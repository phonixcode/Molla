@extends('frontend.layouts.master')

@section('content')
    <!-- Welcome Slides Area -->
    <section class="welcome_area">
        <div class="welSlideTwo owl-carousel">

            @foreach ($banners as $banner)
                <!-- Single Slide -->
                <div class="single_slide home-3 bg-img" style="background-image: url({{ $banner->photo }});">
                    <div class="container h-100">
                        <div class="row h-100 align-items-center">
                            <div class="col-12">
                                <div class="welcome_slide_text text-center">
                                    <p data-animation="fadeInUp" data-delay="100ms">{{ $banner->title }}</p>
                                    <h2 data-animation="fadeInUp" data-delay="300ms">{!! html_entity_decode($banner->description) !!}</h2>
                                    <a href="javascript:void(0);" class="btn btn-primary" data-animation="fadeInUp"
                                        data-delay="500ms">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <!-- Welcome Slides Area -->

    <!-- Top Catagory Area -->
    @if (count($categories) > 0)
    <section class="catagories_area home-3 section_padding_100_70">
        <div class="container">
            <div class="row justify-content-center">
                @foreach ($categories as $cat)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="single_catagory mb-30">
                            <img src="{{ $cat->photo }}" alt="{{ $cat->title }}">
                            <div class="single_cata_desc d-flex align-items-center justify-content-center">
                                <div class="single_cata_desc_text">
                                    <h5>{{ $cat->title }}</h5>
                                    <a href="{{ route('product.category', $cat->slug) }}">
                                        Shop Now
                                        <i class="icofont-rounded-double-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
    <!-- Top Catagory Area -->

    @if (count($new_products) > 0)
    <section class="best-selling-products-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_heading new_arrivals">
                        <h5>New Arrivals</h5>
                    </div>
                </div>
            </div>

            {{-- <div class="row justify-content-center">
                <!-- Single Product -->
                @forelse ($new_products as $item)
                    <div class="col-9 col-sm-6 col-md-4 col-lg-3">
                        @include('frontend.pages.product._single_product', ['item' => $item])
                    </div>
                @empty
                    <p>No new products</p>
                @endforelse
            </div> --}}

            <div class="row">
                <div class="col-12">
                    <div class="new_arrivals_slides owl-carousel">
                        <!-- Single Product -->
                        @forelse ($new_products as $item)
                            <div class="single-product-area">
                                <div class="product_image">
                                    <!-- Product Image -->
                                    @php
                                        $photo = explode(',', $item->photo);
                                    @endphp
                                    <img class="normal_img" src="{{ $photo[0] }}" alt="{{ $item->title }}" />

                                    <!-- Product Badge -->
                                    <div class="product_badge">
                                        <span>{{ $item->stock > 0 ? $item->condition : 'Out of Stock' }}</span>
                                    </div>

                                    <!-- Wishlist -->
                                    <div class="product_wishlist">
                                        <a href="javascript:void(0);" class="add_to_wishlist" data-quantity="1"
                                            data-id="{{ $item->id }}" id="add_to_wishlist_{{ $item->id }}">
                                            <i class="icofont-heart"></i>
                                        </a>
                                    </div>

                                    <!-- Compare -->
                                    <div class="product_compare">
                                        <a href="javascript:void(0);" class="add_to_compare" data-id="{{ $item->id }}"
                                            id="add_to_compare_{{ $item->id }}">
                                            <i class="icofont-exchange"></i>
                                        </a>
                                    </div>
                                </div>

                                <!-- Product Description -->
                                <div class="product_description">
                                    <!-- Add to cart -->
                                    <div class="product_add_to_cart">
                                        <a href="javascript:void(0);" data-quantity="1"
                                            data-product-id="{{ $item->id }}"
                                            class="add_to_cart {{ $item->stock > 0 ? '' : 'deactivate' }}"
                                            id="add_to_cart{{ $item->id }}">
                                            <i class="icofont-shopping-cart"></i>
                                            {{ $item->stock > 0 ? 'Add to Cart' : 'Out of Stock' }}
                                        </a>
                                    </div>

                                    <!-- Quick View -->
                                    <div class="product_quick_view">
                                        <a href="javascript:void(0);" data-toggle="modal"
                                            data-target="#quickview{{ $item->id }}">
                                            <i class="icofont-eye-alt"></i>
                                            Quick View
                                        </a>
                                    </div>

                                    <p class="brand_name">{{ $item->brands[0]['title'] }}</p>
                                    <a
                                        href="{{ route('product.details', $item->slug) }}">{{ ucfirst($item->title) }}</a>
                                    <h6 class="product-price">
                                        ${{ number_format($item->offer_price, 2) }}
                                        @if ($item->discount > 0)
                                            <small><del
                                                    class="text-danger">${{ number_format($item->price, 2) }}</del></small>
                                        @endif
                                    </h6>
                                </div>
                            </div>
                        @empty
                            <p>No new products</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Featured Products Area -->
    <section class="featured_product_area section_padding_100">
        <div class="container">
            <div class="row">
                <!-- Featured Offer Area -->
                <div class="col-12 col-lg-6">
                    <div class="featured_offer_area d-flex align-items-center"
                        style="background-image: url({{ asset($promo_banner->photo) }});">
                        <div class="featured_offer_text">
                            <p>Winter 2022</p>
                            <h2>{!! nl2br($promo_banner->description) !!}</h2>
                            <h4>{{ $promo_banner->title }}</h4>
                            <a href="{{ $promo_banner->slug }}" class="btn btn-primary btn-sm mt-3">Shop Now</a>
                        </div>
                    </div>
                </div>

                <!-- Featured Product Area -->
                <div class="col-12 col-lg-6">
                    <div class="section_heading featured">
                        <h5>Featured Products</h5>
                    </div>

                    <!-- Featured Product Slides -->
                    @if (count($featured_products) > 0)
                    <div class="featured_product_slides owl-carousel">
                        <!-- Single Product -->
                        @foreach ($featured_products as $item)
                            <div class="single-product-area">
                                <div class="product_image">
                                    <!-- Product Image -->
                                    @php
                                        $photo = explode(',', $item->photo);
                                    @endphp
                                    <img class="normal_img" src="{{ $photo[0] }}" alt="{{ $item->title }}">
                                    {{-- <img class="hover_img" src="frontend/img/product-img/new-2-back.png" alt=""> --}}

                                    <!-- Product Badge -->
                                    <div class="product_badge">
                                        <span>{{ $item->stock > 0 ? $item->condition : 'Out of Stock' }}</span>
                                    </div>

                                    <!-- Wishlist -->
                                    <div class="product_wishlist">
                                        <a href="javascript:void(0);" class="add_to_wishlist" data-quantity="1"
                                            data-id="{{ $item->id }}" id="add_to_wishlist_{{ $item->id }}">
                                            <i class="icofont-heart"></i>
                                        </a>
                                    </div>

                                    <!-- Compare -->
                                    <div class="product_compare">
                                        <a href="javascript:void(0);" class="add_to_compare" data-id="{{ $item->id }}"
                                            id="add_to_compare_{{ $item->id }}">
                                            <i class="icofont-exchange"></i>
                                        </a>
                                    </div>
                                </div>

                                <!-- Product Description -->
                                <div class="product_description">
                                    <!-- Add to cart -->
                                    <div class="product_add_to_cart">
                                        <a href="javascript:void(0);" data-quantity="1"
                                            data-product-id="{{ $item->id }}"
                                            class="add_to_cart {{ $item->stock > 0 ? '' : 'deactivate' }}"
                                            id="add_to_cart{{ $item->id }}">
                                            <i class="icofont-shopping-cart"></i>
                                            {{ $item->stock > 0 ? 'Add to Cart' : 'Out of Stock' }}
                                        </a>
                                    </div>

                                    <!-- Quick View -->
                                    <div class="product_quick_view">
                                        <a href="javascript:void(0);" data-toggle="modal"
                                            data-target="#quickview{{ $item->id }}">
                                            <i class="icofont-eye-alt"></i>
                                            Quick View
                                        </a>
                                    </div>

                                    <a
                                        href="{{ route('product.details', $item->slug) }}">{{ ucfirst($item->title) }}</a>
                                    <h6 class="product-price">
                                        ${{ number_format($item->offer_price, 2) }}
                                        @if ($item->discount > 0)
                                            <small><del
                                                    class="text-danger">${{ number_format($item->price, 2) }}</del></small>
                                        @endif
                                    </h6>
                                    <div class="product_rating">
                                        @php
                                            $rate = ceil($item->product_reviews->avg('rate'));
                                        @endphp
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($rate >= $i)
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            @else
                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- Featured Products Area -->

    @if (count($top_products) > 0)
    <section class="best-selling-products-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_heading new_arrivals">
                        <h5>Top Products</h5>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <!-- Single Product -->
                @forelse ($top_products as $item)
                    <div class="col-9 col-sm-6 col-md-4 col-lg-3">
                        @include('frontend.pages.product._single_product', ['item' => $item])
                    </div>
                @empty
                    <p>No items available.</p>
                @endforelse
            </div>
        </div>
    </section>
    @endif

    @if (count($best_rated_products) > 0)
    <section class="best-selling-products-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_heading new_arrivals">
                        <h5>Best Rated</h5>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <!-- Single Product -->
                @forelse ($best_rated_products as $item)
                    <div class="col-9 col-sm-6 col-md-4 col-lg-3">
                        @include('frontend.pages.product._single_product', ['item' => $item])
                    </div>
                @empty
                <p>No items available.</p>
                @endforelse
            </div>
        </div>
    </section>
    @endif

    <!-- Popular Brands Area -->
    @if (count($brands) > 0)
    <section class="popular_brands_area section_padding_100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="popular_section_heading mb-50">
                        <h5>Popular Brands</h5>
                    </div>
                </div>
                <div class="col-12">
                    <div class="popular_brands_slide owl-carousel">
                        @foreach ($brands as $item)
                            <div class="single_brands">
                                <img src="{{ $item->photo }}" alt="{{ $item->title }}">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    <!-- Popular Brands Area -->

    <!-- Special Featured Area -->
    <section class="special_feature_area pt-5">
        <div class="container">
            <div class="row">
                <!-- Single Feature Area -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single_feature_area mb-5 d-flex align-items-center">
                        <div class="feature_icon">
                            <i class="icofont-ship"></i>
                            <span><i class="icofont-check-alt"></i></span>
                        </div>
                        <div class="feature_content">
                            <h6>Free Shipping</h6>
                            <p>For orders above $100</p>
                        </div>
                    </div>
                </div>

                <!-- Single Feature Area -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single_feature_area mb-5 d-flex align-items-center">
                        <div class="feature_icon">
                            <i class="icofont-box"></i>
                            <span><i class="icofont-check-alt"></i></span>
                        </div>
                        <div class="feature_content">
                            <h6>Happy Returns</h6>
                            <p>7 Days free Returns</p>
                        </div>
                    </div>
                </div>

                <!-- Single Feature Area -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single_feature_area mb-5 d-flex align-items-center">
                        <div class="feature_icon">
                            <i class="icofont-money"></i>
                            <span><i class="icofont-check-alt"></i></span>
                        </div>
                        <div class="feature_content">
                            <h6>100% Money Back</h6>
                            <p>If product is damaged</p>
                        </div>
                    </div>
                </div>

                <!-- Single Feature Area -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single_feature_area mb-5 d-flex align-items-center">
                        <div class="feature_icon">
                            <i class="icofont-live-support"></i>
                            <span><i class="icofont-check-alt"></i></span>
                        </div>
                        <div class="feature_content">
                            <h6>Dedicated Support</h6>
                            <p>We provide support 24/7</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Special Featured Area -->

    @include('frontend.pages.home._quick_view')

@endsection

@section('script')
    <script>
        $(document).on('click', '.add_to_cart_icon', function(e) {
            e.preventDefault();
            var product_id = $(this).data('product-id');
            var product_qty = $(this).data('quantity');

            var token = "{{ csrf_token() }}";
            var path = "{{ route('cart.store') }}";

            $.ajax({
                url: path,
                type: 'POST',
                dataType: 'json',
                data: {
                    product_id: product_id,
                    product_qty: product_qty,
                    _token: token,
                },
                beforeSend: function() {
                    $('#add_to_cart_icon' + product_id).html('<i class="fa fa-spinner fa-spin"></i>');
                },
                complete: function() {
                    $('#add_to_cart_icon' + product_id).html(
                        '<i class="icofont-shopping-cart"></i>');
                },
                success: function(data) {
                    //console.log(data);
                    $('body #header-ajax').html(data['header']);
                    $('body #cart-counter').html(data['cart_count']);
                    if (data['status']) {
                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": 300,
                            "hideDuration": 1000,
                            "timeOut": 5000,
                            "extendedTimeOut": 1000,
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                        toastr.success(data['message']);
                    }
                },
                error: function(err) {
                    toastr.error("Something went wrong!, please try again later");
                }
            })
        });
    </script>
@endsection
