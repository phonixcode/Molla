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
                        <h5 class="mb-3">Account Details</h5>

                        <form action="{{ route('update.account', $user->uuid) }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="">Full Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('full_name') is-invalid @enderror" id="full_name" placeholder="eg. jane mira" value="{{ $user->full_name }}" name="full_name">
                                        @error('full_name')
                                            <p class="text-danger" style="font-size: 12px;">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="">Display Name</label>
                                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="eg. mira" value="{{ $user->username }}">
                                        @error('username')
                                            <p class="text-danger" style="font-size: 12px;">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">Phone Number</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                                            placeholder="eg. 90919999991" value="{{ $user->phone }}" name="phone">
                                            @error('phone')
                                                <p class="text-danger" style="font-size: 12px;">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">Email Address <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="email" placeholder="eg. mira@meloy.com"
                                            value="{{ $user->email }}" name="email" disabled>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="oldpassword">Current Password (Leave blank to leave unchanged)</label>
                                        <input type="password" class="form-control" id="oldpassword" name="oldpassword">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="newpassword">New Password (Leave blank to leave unchanged)</label>
                                        <input type="password" class="form-control @error('newpassword') is-invalid @enderror" id="newpassword" name="newpassword">
                                        @error('newpassword')
                                            <p class="text-danger" style="font-size: 12px;">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- My Account Area -->
@endsection
