<!doctype html>
<html lang="en">

<head>
    @include('frontend.layouts.head')
</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="spinner-grow" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

    <!-- Header Area -->
    <header class="header_area" id="header-ajax">
        @include('frontend.layouts.header')
    </header>
    <!-- Header Area End -->

    @yield('content')

    <!-- Footer Area -->
    @include('frontend.layouts.footer')
    <!-- Footer Area -->

    @include('frontend.layouts.script')

</body>

</html>
