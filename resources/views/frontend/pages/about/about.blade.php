@extends('frontend.layouts.master')

@section('content')
    <!-- Breadcumb Area -->
    <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>About Us</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">About Us</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <!-- About Us Area -->
    <section class="about_us_area section_padding_100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-6">
                    <div class="about_us_content pb-5 pb-lg-0">
                        <div class="row">
                            <div class="col-6">
                                <img src="{{ asset('frontend/img/gallery/1.png') }}" alt="">
                            </div>
                            <div class="col-6">
                                <img src="{{ asset('frontend/img/gallery/2.png') }}" alt="">
                            </div>
                            <div class="col-6">
                                <img src="{{ asset('frontend/img/gallery/3.png') }}" alt="">
                            </div>
                            <div class="col-6">
                                <img src="{{ asset('frontend/img/gallery/4.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="about_us_content pl-0 pl-lg-5">
                        <h5>Molla is elegant e-commerce plateform. It's suitable for all e-commerce platform.</h5>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione quibusdam saepe alias
                            dignissimos consequatur ullam expedita voluptas commodi veritatis repellendus nostrum, tempore,
                            ducimus architecto iure.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Us Area -->

    <!-- Features Area -->
    <section class="features-area mb-50">
        <div class="container">
            <div class="row">
                <!-- Single Service Area -->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-service-area mb-50">
                        <i class="icofont-ssl-security"></i>
                        <h5>Secure Payment Gateway</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita, et, nobis?</p>
                    </div>
                </div>
                <!-- Single Service Area -->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-service-area mb-50">
                        <i class="icofont-badge"></i>
                        <h5>Quality Products</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita, et, nobis?</p>
                    </div>
                </div>
                <!-- Single Service Area -->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-service-area mb-50">
                        <i class="icofont-fast-delivery"></i>
                        <h5>Fast Delivery</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita, et, nobis?</p>
                    </div>
                </div>
                <!-- Single Service Area -->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-service-area mb-50">
                        <i class="icofont-cash-on-delivery"></i>
                        <h5>Cash On Delivery</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita, et, nobis?</p>
                    </div>
                </div>
                <!-- Single Service Area -->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-service-area mb-50">
                        <i class="icofont-gift"></i>
                        <h5>Free Delivery</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita, et, nobis?</p>
                    </div>
                </div>
                <!-- Single Service Area -->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-service-area mb-50">
                        <i class="icofont-life-bouy"></i>
                        <h5>Customer Support</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita, et, nobis?</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonial Area -->
    <section class="testimonials_area bg-gray section_padding_100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-6">
                    <div class="popular_section_heading mb-50 text-center">
                        <h5 class="mb-3">Few Words from Clients</h5>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur saepe labore adipisci
                            assumenda molestiae, omnis, quod ipsa facere praesentium.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <div class="testimonials_slides owl-carousel">
                        <div class="single_tes_slide text-center">
                            <img src="{{ asset('frontend/img/partner-img/tes-1.png') }}" alt="">
                            <h6>Molla is smart &amp; elegant e-commerce platform.</h6>
                            <p>Emm Sarah</p>
                            <span>Support Manager</span>
                        </div>

                        <div class="single_tes_slide text-center">
                            <img src="{{ asset('frontend/img/partner-img/tes-2.png') }}" alt="">
                            <h6>Molla is smart &amp; elegant e-commerce platform.</h6>
                            <p>Nazrul Islam</p>
                            <span>Support Manager</span>
                        </div>

                        <div class="single_tes_slide text-center">
                            <img src="{{ asset('frontend/img/partner-img/tes-3.png') }}" alt="">
                            <h6>Molla is smart &amp; elegant e-commerce platform.</h6>
                            <p>Justin Align</p>
                            <span>Support Manager</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonial Area End -->

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
    <!-- Popular Brands Area End -->
@endsection
