<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.layouts.partials.head')
</head>

<body class="light-sidebar">
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

            <!-- begin app-header -->
            @include('admin.layouts.partials.nav')
            <!-- end app-header -->

            <!-- begin app-container -->
            <div class="app-container">
                <!-- begin app-nabar -->
                @include('admin.layouts.partials.sidebar')
                <!-- end app-navbar -->

                <!-- begin app-main -->
                @yield('content')
                <!-- end app-main -->

            </div>
            <!-- end app-container -->

            @include('admin.layouts.partials.footer')
        </div>
        <!-- end app-wrap -->
    </div>
    <!-- end app -->

    @include('admin.layouts.partials.script')

</body>

</html>
