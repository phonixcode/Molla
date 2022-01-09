@extends('frontend.layouts.master')

@section('content')

    <!-- Breadcumb Area -->
    <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>Register</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Register</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <!-- Login Area -->
    <div class="bigshop_reg_log_area section_padding_100_50">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6">
                    <div class="login_form mb-50">
                        <h5 class="mb-3" align="center">REGISTER</h5>

                        <form action="{{ route('register.submit') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control @error('full_name') is-invalid @enderror" name="full_name" id="full_name"
                                    placeholder="Full Name" value="{{ old('full_name') }}">
                                @error('full_name')
                                    <p class="text-danger" style="font-size: 12px;">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username"
                                    placeholder="Username" value="{{ old('username') }}">
                                @error('username')
                                    <p class="text-danger" style="font-size: 12px;">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" id="email" placeholder="Email">
                                @error('email')
                                    <p class="text-danger" style="font-size: 12px;">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password"
                                    placeholder="Password">
                                @error('password')
                                    <p class="text-danger" style="font-size: 12px;">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password_confirmation" id="cpassword_confirmation"
                                    placeholder="Confirm Password">
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">Register</button>
                            <div class="forget_pass mt-15" align="center">
                                Already have an account?
                                <a href="{{ route('user.auth.login') }}"> login</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login Area End -->

@endsection
