@extends('frontend.layouts.master')

@section('content')
    @include('frontend.pages.checkout._includes.breadcumb')

    <!-- Checkout Step Area -->
    <div class="checkout_steps_area">
        <a class="complated" href="checkout-1.html"><i class="icofont-check-circled"></i> Login</a>
        <a class="complated" href="checkout-2.html"><i class="icofont-check-circled"></i> Billing</a>
        <a class="complated" href="checkout-3.html"><i class="icofont-check-circled"></i> Shipping</a>
        <a class="complated" href="checkout-4.html"><i class="icofont-check-circled"></i> Payment</a>
        <a class="active" href="checkout-5.html"><i class="icofont-check-circled"></i> Review</a>
    </div>
    <!-- Checkout Step Area -->

    <!-- Checkout Area -->
    <div class="checkout_area section_padding_100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="checkout_details_area clearfix">
                        <h5 class="mb-30">Review Your Order</h5>

                        <div class="cart-table">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-30">
                                    <thead>
                                        <tr>
                                            <th scope="col">Image</th>
                                            <th scope="col">Product</th>
                                            <th scope="col">Unit Price</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (Cart::instance('shopping')->content() as $item)
                                            <tr>
                                                <td>
                                                    @php
                                                        $photo = explode(',', $item->model->photo);
                                                    @endphp
                                                    <img src="{{ $photo[0] }}" alt="Product" style="width: 50px; height: 50px;">
                                                </td>
                                                <td>
                                                    <a href="{{ route('product.details', $item->model->slug) }}">
                                                        {{ $item->name }}
                                                    </a>
                                                </td>
                                                <td>${{ number_format($item->price, 2) }}</td>
                                                <td>{{ $item->qty }}</td>
                                                <td>${{$item->subtotal() }}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-7 ml-auto">
                    <div class="cart-total-area">
                        <h5 class="mb-3">Cart Totals</h5>
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <tbody>
                                    <tr>
                                        <td>Sub Total</td>
                                        <td>${{ Cart::subtotal() }}</td>
                                    </tr>
                                    <tr>
                                        <td>Shipping</td>
                                        <td>${{ number_format(session()->get('checkout')[0]['delivery_charge'], 2) }}</td>
                                    </tr>
                                    @if (session()->has('coupon'))
                                        <tr>
                                            <td>Coupon</td>
                                            <td>${{ number_format(session()->get('coupon')['value'], 2) }}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        @php
                                            $subtotal = floatval(implode(explode(',', Cart::subtotal())));
                                        @endphp
                                        <td>Total</td>
                                        @if (session()->has('coupon'))
                                            <td>
                                                ${{ number_format($subtotal + session()->get('checkout')[0]['delivery_charge'] - session()->get('coupon')['value'], 2) }}
                                            </td>
                                        @elseif (session()->has('checkout'))
                                            <td>
                                                ${{ number_format($subtotal + session()->get('checkout')[0]['delivery_charge'], 2) }}
                                            </td>
                                        @endif
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="checkout_pagination d-flex justify-content-end mt-3">
                            <a href="checkout-4.html" class="btn btn-primary mt-2 ml-2 d-none d-sm-inline-block">Go Back</a>
                            <a href="{{ route('checkout.submit') }}" class="btn btn-primary mt-2 ml-2">Confirm</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Checkout Area End -->

@endsection
