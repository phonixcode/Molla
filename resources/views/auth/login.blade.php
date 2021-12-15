<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.layouts.partials.head')
</head>

<body class="bg-white">
    <!-- begin app -->
    <div class="app">
        <!-- begin app-wrap -->
        <div class="app-wrap">
            <!-- begin pre-loader -->
            <div class="loader">
                <div class="h-100 d-flex justify-content-center">
                    <div class="align-self-center">
                        <img src="{{ asset('backend/assets/img/loader/loader.svg') }}" alt="loader">
                    </div>
                </div>
            </div>
            <!-- end pre-loader -->

            <!--start login contant-->
            <div class="app-contant">
                <div class="bg-white">
                    <div class="container-fluid p-0">
                        <div class="row no-gutters">
                            <div class="col-sm-6 col-lg-5 col-xxl-3  align-self-center order-2 order-sm-1">
                                <div class="d-flex align-items-center h-100-vh">
                                    <div class="login p-50">
                                        {{-- <h1 class="mb-2">We Are Mentor</h1> --}}
                                        <p>Welcome back, please login to your account.</p>
                                        <form method="POST" action="{{ route('login') }}" class="mt-3 mt-sm-5">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Email <span class="text-danger">*</span></label>
                                                        <input id="email" type="email"
                                                            class="form-control @error('email') is-invalid @enderror"
                                                            placeholder="Email" name="email"
                                                            value="{{ old('email') }}" required autocomplete="email"
                                                            autofocus>

                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Password <span class="text-danger">*</span></label>
                                                        <input id="password" type="password"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        name="password" required autocomplete="current-password"
                                                        placeholder="*********">

                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="d-block d-sm-flex  align-items-center">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="remember">
                                                                Remember Me
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 mt-3">
                                                    <button type="submit" class="btn btn-primary text-uppercase">Sign
                                                        In</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xxl-9 col-lg-7 bg-gradient o-hidden order-1 order-sm-2">
                                <div class="row align-items-center h-100">
                                    <div class="col-7 mx-auto ">
                                        <img class="img-fluid"
                                            src="{{ asset('frontend/img/product-img/beach.png') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end login contant-->
        </div>
        <!-- end app-wrap -->
    </div>
    <!-- end app -->

    @include('admin.layouts.partials.script')
</body>

</html>
