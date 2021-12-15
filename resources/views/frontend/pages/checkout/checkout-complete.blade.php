@extends('frontend.layouts.master')

@section('content')
    @include('frontend.pages.checkout._includes.breadcumb')

    <!-- Checkout Area -->
    <div class="checkout_area section_padding_100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="order_complated_area clearfix">
                        <h5>Thank You For Your Order.</h5>
                        <p>You will receive an email of your order details</p>
                        <p class="orderid mb-0">Your Order id #{{ $order }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Checkout Area End -->
@endsection
