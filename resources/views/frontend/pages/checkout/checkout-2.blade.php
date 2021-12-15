@extends('frontend.layouts.master')

@section('content')

    @include('frontend.pages.checkout._includes.breadcumb')

    <!-- Checkout Steps Area -->
    <div class="checkout_steps_area">
        <a class="complated" href="checkout-2.html"><i class="icofont-check-circled"></i> Billing</a>
        <a class="active" href="checkout-3.html"><i class="icofont-check-circled"></i> Shipping</a>
        <a href="checkout-4.html"><i class="icofont-check-circled"></i> Payment</a>
        <a href="checkout-5.html"><i class="icofont-check-circled"></i> Review</a>
    </div>
    <!-- Checkout Steps Area -->

    <!-- Checkout Area -->
    <div class="checkout_area section_padding_100">
        <div class="container">
            <form action="{{ route('checkout.two.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="checkout_details_area clearfix">
                            <h5 class="mb-4">Shipping Method</h5>

                            <div class="shipping_method">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">Method</th>
                                                <th scope="col">Delivery Time</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Choose</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($shippings as $key => $item)
                                                <tr>
                                                    <th scope="row">{{ $item->method }}</th>
                                                    <td>{{ $item->delivery_time }}</td>
                                                    <td>${{ number_format($item->delivery_charge, 2) }}</td>
                                                    <td>
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" required id="customRadio{{ $key }}"
                                                                name="delivery_charge"
                                                                value="{{ $item->delivery_charge }}"
                                                                class="custom-control-input" required>
                                                            <label class="custom-control-label"
                                                                for="customRadio{{ $key }}"></label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr colspan="3">No Shipping Method Found !</tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="checkout_pagination mt-3 d-flex justify-content-end clearfix">
                            <a href="{{ route('checkout.one') }}" class="btn btn-primary mt-2 ml-2">Go Back</a>
                            <button type="submit" class="btn btn-primary mt-2 ml-2">Continue</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <!-- Checkout Area End -->

@endsection
