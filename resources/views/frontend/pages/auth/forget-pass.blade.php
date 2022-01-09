@extends('frontend.layouts.master')

@section('content')

    <!-- Breadcumb Area -->
    <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>Forget Password</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Forgot Password</li>
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
                        <h5 class="mb-3" align="center">Forget Password</h5>

                        <form action="{{ route('forget.pass.submit') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                    id="email" placeholder="Email" value="{{ old('email') }}">
                                @error('email')
                                    <p class="text-danger" style="font-size: 12px;">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login Area End -->

@endsection
