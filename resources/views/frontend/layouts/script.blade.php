<!-- jQuery (Necessary for All JavaScript Plugins) -->
<script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
<script src="{{ asset('frontend/js/popper.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.easing.min.js') }}"></script>
<script src="{{ asset('frontend/js/default/classy-nav.min.js') }}"></script>
<script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/js/default/scrollup.js') }}"></script>
<script src="{{ asset('frontend/js/waypoints.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.countdown.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('frontend/js/jarallax.min.js') }}"></script>
<script src="{{ asset('frontend/js/jarallax-video.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('frontend/js/wow.min.js') }}"></script>
<script src="{{ asset('frontend/js/default/active.js') }}"></script>
{{-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

{{-- <script>
    $(document).ready(function() {
        var path = "{{ route('auto.search') }}";
        $('#search-text').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: path,
                    dataType: 'json',
                    data: {
                        term: request.term
                    },
                    success: function(data) {
                        response(data);
                    },
                    minLength: 1
                })
            }
        });
    });
</script> --}}

<script>
    // add to cart
    $(document).on('click', '.add_to_cart', function(e) {
        e.preventDefault();
        var product_id = $(this).data('product-id');
        var product_qty = $(this).data('quantity');

        var token = "{{ csrf_token() }}";
        var path = "{{ route('cart.store') }}";

        $.ajax({
            url: path,
            type: 'POST',
            dataType: 'json',
            data: {
                product_id: product_id,
                product_qty: product_qty,
                _token: token,
            },
            beforeSend: function() {
                $('#add_to_cart' + product_id).html('<i class="fa fa-spinner fa-spin"></i>');
            },
            complete: function() {
                $('#add_to_cart' + product_id).html(
                    '<i class="icofont-shopping-cart"></i> Add to cart');
            },
            success: function(data) {
                //console.log(data);
                $('body #header-ajax').html(data['header']);
                $('body #cart-counter').html(data['cart_count']);
                if (data['status']) {
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": 300,
                        "hideDuration": 1000,
                        "timeOut": 5000,
                        "extendedTimeOut": 1000,
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    toastr.success(data['message']);
                }
            },
            error: function(err) {
                toastr.error("Something went wrong!, please try again later");
            }
        })
    });

    // delete from cart
    $(document).on('click', '.cart_delete', function(e) {
        e.preventDefault();
        var cart_id = $(this).data('id');

        var token = "{{ csrf_token() }}";
        var path = "{{ route('cart.delete') }}";

        $.ajax({
            url: path,
            type: 'POST',
            dataType: 'json',
            data: {
                cart_id: cart_id,
                _token: token,
            },
            success: function(data) {
                $('body #header-ajax').html(data['header']);
                $('body #cart-counter').html(data['cart_count']);
                $('body #cart-list').html(data['cart_list']);

                if (data['status']) {
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": 300,
                        "hideDuration": 1000,
                        "timeOut": 5000,
                        "extendedTimeOut": 1000,
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    toastr.success(data['message']);
                }
            },
            error: function(err) {
                toastr.error("Something went wrong!, please try again later");
            }
        })
    });

    // add to wishlist
    $(document).on('click', '.add_to_wishlist', function(e) {
        e.preventDefault();
        var product_id = $(this).data('id');
        var product_qty = $(this).data('quantity');

        var token = "{{ csrf_token() }}";
        var path = "{{ route('wishlist.store') }}";

        $.ajax({
            url: path,
            type: 'POST',
            dataType: 'json',
            data: {
                product_id: product_id,
                product_qty: product_qty,
                _token: token,
            },
            beforeSend: function() {
                $('#add_to_wishlist_' + product_id).html('<i class="fa fa-spinner fa-spin"></i>');
            },
            complete: function() {
                $('#add_to_wishlist_' + product_id).html(
                    '<i class="icofont-heart"></i>');
            },
            success: function(data) {
                if (data['status']) {
                    $('body #header-ajax').html(data['header']);
                    $('body #wishlist-counter').html(data['wishlist_count']);
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": 300,
                        "hideDuration": 1000,
                        "timeOut": 5000,
                        "extendedTimeOut": 1000,
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    toastr.success(data['message']);
                } else if (data['present']) {
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": 300,
                        "hideDuration": 1000,
                        "timeOut": 5000,
                        "extendedTimeOut": 1000,
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    toastr.warning(data['message']);
                }
            },
            error: function(err) {
                toastr.error("Something went wrong!, please try again later");
            }
        })
    });
</script>

@yield('script')


<script>
    @if (Session::has('success'))
        toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": 300,
        "hideDuration": 1000,
        "timeOut": 5000,
        "extendedTimeOut": 1000,
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
        }
        toastr.success("{{ session('success') }}")

    @elseif (Session::has('error'))
        toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": 300,
        "hideDuration": 1000,
        "timeOut": 5000,
        "extendedTimeOut": 1000,
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
        }

        toastr.error("{{ session('error') }}")
    @endif
</script>
