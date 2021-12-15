@php
    $setting = \App\Models\Settings::first();
@endphp
<footer class="footer_area section_padding_100_0">
    <div class="container">
        <div class="row">
            <!-- Single Footer Area -->
            <div class="col-12 col-sm-6 col-md-5 col-lg-4 col-xl-3">
                <div class="single_footer_area mb-100">
                    <div class="footer_heading mb-4">
                        <h6>Contact Us</h6>
                    </div>
                    <ul class="footer_content">
                        <li><span>Address:</span> {{ $setting->address }}</li>
                        <li><span>Phone:</span> {{ $setting->phone }}</li>
                        <li><span>FAX:</span> {{ $setting->fax }}</li>
                        <li><span>Email:</span> {{ $setting->email }}</li>
                    </ul>
                    <div class="footer_social_area mt-15">
                        <a href="{{ $setting->facebook_url }}"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        <a href="{{ $setting->twitter_url }}"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        <a href="{{ $setting->pinterest_url }}"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                        <a href="{{ $setting->instagram_url }}"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>

            <!-- Single Footer Area -->
            <div class="col-12 col-sm-6 col-md col-lg-4 col-xl-2">
                <div class="single_footer_area mb-100">
                    <div class="footer_heading mb-4">
                        <h6>Information</h6>
                    </div>
                    <ul class="footer_widget_menu">
                        <li><a href="#"><i class="icofont-rounded-right"></i> Your Account</a></li>
                        <li><a href="#"><i class="icofont-rounded-right"></i> Free Shipping Policy</a></li>
                        <li><a href="#"><i class="icofont-rounded-right"></i> Your Cart</a></li>
                        <li><a href="#"><i class="icofont-rounded-right"></i> Return Policy</a></li>
                        <li><a href="#"><i class="icofont-rounded-right"></i> Free Coupon</a></li>
                        <li><a href="#"><i class="icofont-rounded-right"></i> Delivary Info</a></li>
                    </ul>
                </div>
            </div>

            <!-- Single Footer Area -->
            <div class="col-12 col-sm-6 col-md col-lg-4 col-xl-2">
                <div class="single_footer_area mb-100">
                    <div class="footer_heading mb-4">
                        <h6>Account</h6>
                    </div>
                    <ul class="footer_widget_menu">
                        <li><a href="#"><i class="icofont-rounded-right"></i> Product Support</a></li>
                        <li><a href="#"><i class="icofont-rounded-right"></i> Terms &amp; Conditions</a></li>
                        <li><a href="#"><i class="icofont-rounded-right"></i> Help</a></li>
                        <li><a href="#"><i class="icofont-rounded-right"></i> Payment Method</a></li>
                        <li><a href="#"><i class="icofont-rounded-right"></i> Affiliate Program</a></li>
                        <li><a href="#"><i class="icofont-rounded-right"></i> Privacy Policy</a></li>
                    </ul>
                </div>
            </div>

            <!-- Single Footer Area -->
            <div class="col-12 col-sm-6 col-md-5 col-lg-4 col-xl-2">
                <div class="single_footer_area mb-100">
                    <div class="footer_heading mb-4">
                        <h6>Support</h6>
                    </div>
                    <ul class="footer_widget_menu">
                        <li><a href="#"><i class="icofont-rounded-right"></i> Payment Method</a></li>
                        <li><a href="#"><i class="icofont-rounded-right"></i> Help</a></li>
                        <li><a href="#"><i class="icofont-rounded-right"></i> Product Support</a></li>
                        <li><a href="#"><i class="icofont-rounded-right"></i> Terms &amp; Conditions</a></li>
                        <li><a href="#"><i class="icofont-rounded-right"></i> Privacy Policy</a></li>
                        <li><a href="#"><i class="icofont-rounded-right"></i> Affiliate Program</a></li>
                    </ul>
                </div>
            </div>

            <!-- Single Footer Area -->
            <div class="col-12 col-md-7 col-lg-8 col-xl-3">
                <div class="single_footer_area mb-50">
                    <div class="footer_heading mb-4">
                        <h6>Join our mailing list</h6>
                    </div>
                    <div class="subscribtion_form">
                        <form action="#" method="post">
                            <input type="email" name="mail" class="form-control mail" placeholder="Your E-mail Addrees">
                            <button type="submit" class="submit"><i class="icofont-long-arrow-right"></i></button>
                        </form>
                    </div>
                </div>
                <div class="single_footer_area mb-100">
                    <div class="footer_heading mb-4">
                        <h6>Download our Mobile Apps</h6>
                    </div>
                    <div class="apps_download">
                        <a href="#"><img src="{{ asset('frontend/img/core-img/play-store.png') }}" alt="Play Store"></a>
                        <a href="#"><img src="{{ asset('frontend/img/core-img/app-store.png') }}" alt="Apple Store"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer_bottom_area">
        <div class="container">
            <div class="row align-items-center">
                <!-- Copywrite -->
                <div class="col-12 col-md-6">
                    <div class="copywrite_text">
                        <p>Copyright © {{date('Y')}} </p>
                    </div>
                </div>
                <!-- Payment Method -->
                <div class="col-12 col-md-6">
                    <div class="payment_method">
                        <img src="{{ asset('frontend/img/payment-method/paypal.png') }}" alt="">
                        <img src="{{ asset('frontend/img/payment-method/maestro.png') }}" alt="">
                        <img src="{{ asset('frontend/img/payment-method/western-union.png') }}" alt="">
                        <img src="{{ asset('frontend/img/payment-method/discover.png') }}" alt="">
                        <img src="{{ asset('frontend/img/payment-method/american-express.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
