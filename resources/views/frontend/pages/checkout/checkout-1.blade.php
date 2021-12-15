@extends('frontend.layouts.master')

@section('content')

    @include('frontend.pages.checkout._includes.breadcumb')


    <!-- Checkout Steps Area -->
    <div class="checkout_steps_area">
        <a href="checkout-2.html" class="active"><i class="icofont-check-circled"></i> Billing</a>
        <a href="checkout-3.html"><i class="icofont-check-circled"></i> Shipping</a>
        <a href="checkout-4.html"><i class="icofont-check-circled"></i> Payment</a>
        <a href="checkout-5.html"><i class="icofont-check-circled"></i> Review</a>
    </div>

    <!-- Checkout Area -->
    <div class="checkout_area section_padding_100">
        <div class="container">
            <form action="{{ route('checkout.one.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>

                    <div class="col-12">
                        <div class="checkout_details_area clearfix">
                            <h5 class="mb-4">Billing Details</h5>
                            <div class="row">
                                @php
                                    $name = explode(' ', $user->full_name);
                                @endphp
                                <div class="col-md-6 mb-3">
                                    <label for="first_name">First Name</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name"
                                        placeholder="First Name" value="{{ $name[0] }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name"
                                        placeholder="Last Name" value="{{ $name[1] }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="phone_number">Phone Number</label>
                                    <input type="text" class="form-control" id="phone" name="phone" min="0"
                                        value="{{ $user->phone }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email_address">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Email Address" value="{{ $user->email }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="country">Country</label>
                                    <input type="text" class="form-control" id="country" placeholder="Country"
                                        name="country" value="{{ $user->country }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="postcode">Postcode/Zip</label>
                                    <input type="text" class="form-control" id="postcode" name="postcode"
                                        placeholder="Postcode / Zip" value="{{ $user->postcode }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="city">Town/City</label>
                                    <input type="text" class="form-control" id="city" name="city" placeholder="Town/City"
                                        value="{{ $user->city }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="state">State</label>
                                    <input type="text" class="form-control" id="state" name="state" placeholder="State"
                                        value="{{ $user->state }}">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        placeholder="Address" value="{{ $user->address }}">
                                </div>
                                <div class="col-md-12">
                                    <label for="order-notes">Order Notes</label>
                                    <textarea class="form-control" id="order-notes" name="note" cols="30" rows="10"
                                        placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                </div>
                            </div>

                            <!-- Different Shipping Address -->
                            <div class="different-address mt-50">
                                <div class="ship-different-title mb-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">Ship to a different
                                            address?</label>
                                    </div>
                                </div>
                                <div class="row shipping_input_field">
                                    <div class="col-md-6 mb-3">
                                        <label for="first_name">First Name</label>
                                        <input type="text" class="form-control" id="s_first_name" name="s_first_name"
                                            placeholder="First Name" value="{{ $name[0] }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" class="form-control" id="s_last_name" name="s_last_name"
                                            placeholder="Last Name" value="{{ $name[1] }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email_address">Email Address</label>
                                        <input type="email" class="form-control" id="s_email" name="s_email"
                                            placeholder="Email Address" value="{{ $user->email }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="phone_number">Phone Number</label>
                                        <input type="text" class="form-control" id="s_phone" name="s_phone" min="0"
                                            value="{{ $user->phone }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="country">Country</label>
                                        <input type="text" class="form-control" id="s_country" placeholder="Country"
                                            name="s_country" value="{{ $user->country }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="postcode">Postcode/Zip</label>
                                        <input type="text" class="form-control" id="s_postcode" name="s_postcode"
                                            placeholder="Postcode / Zip" value="{{ $user->postcode }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="city">Town/City</label>
                                        <input type="text" class="form-control" id="s_city" name="s_city"
                                            placeholder="Town/City" value="{{ $user->city }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="state">State</label>
                                        <input type="text" class="form-control" id="s_state" name="s_state"
                                            placeholder="State" value="{{ $user->state }}">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" id="s_address" name="s_address"
                                            placeholder="Address" value="{{ $user->address }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <input type="hidden" name="sub_total" value="{{ Cart::instance('shopping')->subtotal() }}">
                        <input type="hidden" name="total" value="{{ Cart::instance('shopping')->subtotal() }}">
                        <div class="checkout_pagination d-flex justify-content-end mt-50">
                            <a href="{{ route('cart') }}" class="btn btn-primary mt-2 ml-2">Go Back</a>
                            <button type="submit" class="btn btn-primary mt-2 ml-2">Continue</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Checkout Area -->
@endsection

@section('script')
    <script>
        $('#customCheck1').on('change', function(e) {
            e.preventDefault();
            if (this.checked) {
                $('#s_first_name').val($('#first_name').val());
                $('#s_last_name').val($('#last_name').val());
                $('#s_email').val($('#email').val());
                $('#s_phone').val($('#phone').val());
                $('#s_country').val($('#country').val());
                $('#s_city').val($('#city').val());
                $('#s_postcode').val($('#postcode').val());
                $('#s_state').val($('#state').val());
                $('#s_address').val($('#address').val());
            } else {
                $('#s_first_name').val("");
                $('#s_last_name').val("");
                $('#s_email').val("");
                $('#s_phone').val("");
                $('#s_country').val("");
                $('#s_city').val("");
                $('#s_postcode').val("");
                $('#s_state').val("");
                $('#s_address').val("");
            }
        });
    </script>
@endsection
