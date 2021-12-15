@extends('frontend.layouts.master')

@section('content')

    <!-- Breadcumb Area -->
    <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>My Account</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">My Account</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <!-- My Account Area -->
    <section class="my-account-area section_padding_100_50">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-3">
                    @include('frontend.user._includes.sidebar')
                </div>
                <div class="col-12 col-lg-9">
                    <div class="my-account-content mb-50">
                        <p>The following addresses will be used on the checkout page by default.</p>

                        <div class="row">
                            <div class="col-12 col-lg-6 mb-5 mb-lg-0">
                                <h6 class="mb-3">Billing Address</h6>
                                <address>
                                    {{ $user->address }}<br>
                                    {{ $user->state }}, {{ $user->city }} <br>
                                    {{ $user->country }} <br>
                                    {{ $user->postcode }}
                                </address>
                                <a href="#" class="btn btn-primary btn-sm" data-toggle="modal"
                                    data-target="#editBillingAddress">Edit Address</a>
                            </div>
                            <div class="col-12 col-lg-6">
                                <h6 class="mb-3">Shipping Address</h6>
                                {{-- <address>
                                    You have not set up this type of address yet.
                                </address> --}}
                                <address>
                                    {{ $user->s_address }}<br>
                                    {{ $user->s_state }}, {{ $user->s_city }} <br>
                                    {{ $user->s_country }} <br>
                                    {{ $user->s_postcode }}
                                </address>
                                <a href="#" class="btn btn-primary btn-sm" data-toggle="modal"
                                    data-target="#editShippingAddress">Edit Address</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- My Account Area -->

    <!-- Billing Addresses Modal -->
    <div class="modal fade" id="editBillingAddress" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Edit Billing Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('billing.address', $user->uuid) }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Address</label>
                            <textarea name="address" id="address" class="form-control"
                                placeholder="eg. gate street lagos state">{{ $user->address }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Country</label>
                            <input type="text" name="country" id="country" class="form-control" placeholder="Country"
                                value="{{ $user->country }}" />
                        </div>
                        <div class="form-group">
                            <label for="">PostCode</label>
                            <input type="number" name="postcode" id="postcode" class="form-control" placeholder="Postcode / Zip"
                                value="{{ $user->postcode }}" />
                        </div>
                        <div class="form-group">
                            <label for="">State</label>
                            <input name="state" id="state" class="form-control" placeholder="eg. Lagos state"
                                value="{{ $user->state }}" />
                        </div>
                        <div class="form-group">
                            <label for="">City</label>
                            <input name="city" id="city" class="form-control" placeholder="eg. Apapa"
                                value="{{ $user->city }}" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Shipping Addresses Modal -->
    <div class="modal fade" id="editShippingAddress" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Edit Shipping Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('shipping.address', $user->uuid) }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Shipping Address</label>
                            <textarea name="s_address" id="s_address" class="form-control"
                                placeholder="eg. gate street lagos state">{{ $user->s_address }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Shipping Country</label>
                            <input name="s_country" id="s_country" class="form-control" placeholder="eg. Nigeria"
                                value="{{ $user->s_country }}" />
                        </div>
                        <div class="form-group">
                            <label for="">Shipping PostCode</label>
                            <input type="number" name="s_postcode" id="s_postcode" class="form-control" placeholder="eg. 100001"
                                value="{{ $user->s_postcode }}" />
                        </div>
                        <div class="form-group">
                            <label for="">Shipping State</label>
                            <input name="s_state" id="s_state" class="form-control" placeholder="eg. Lagos state"
                                value="{{ $user->s_state }}" />
                        </div>
                        <div class="form-group">
                            <label for="">Shipping City</label>
                            <input name="s_city" id="s_city" class="form-control" placeholder="eg. Apapa"
                                value="{{ $user->s_city }}" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
