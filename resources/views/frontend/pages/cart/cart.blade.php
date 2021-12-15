@extends('frontend.layouts.master')

@section('content')
    <!-- Breadcumb Area -->
    <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>Cart</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Cart</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    @if (Cart::instance('shopping')->count() > 0)
        <!-- Cart Area -->
        <div class="cart_area section_padding_100_70 clearfix" id="cart-list">
            @include('frontend.pages.cart._cart_lists')
        </div>
        <!-- Cart Area End -->
    @else
    <section class="error_page text-center section_padding_100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-6">
                    <div class="not-found-text">
                        <img src="{{ asset('frontend/img/empty-cart.svg') }}" alt="">
                        <h5 class="mb-3 mt-5">Your cart is currently empty</h5>
                        <p>Before proceed to checkout you must add some products to your shopping cart. You will find a lot of interesting products on our "Product" page.</p>
                        <a href="{{ route('products') }}" class="btn btn-primary mt-3"> Start Shopping</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

@endsection

@section('script')

    <script>
        $(document).on('click', '.coupon-btn', function(e) {
            e.preventDefault();
            var code = $('input[name=code]').val();
            $('.coupon-btn').html('<i class="fa fa-spinner fa-spin"></i> Applying...');
            $('#coupon-form').submit();
        });
    </script>

    <script>
        $(document).on('click', '.delete-cart-item', function(e) {
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
    </script>

    <script>
        $(document).on('click', '.qty-text', function() {
            var id = $(this).data('id');
            var spinner = $(this),
                input = spinner.closest("div.quantity").find('input[type="number"]');

            if (input.val() == 1) return false;

            if (input.val() != 1) {
                var newValue = parseFloat(input.val());
                $('#qty-input-' + id).val(newValue);
            }

            var productQuantity = $("#update-cart-" + id).data('product-quantity');
            update_cart(id, productQuantity);
        });

        function update_cart(id, productQuantity) {
            var rowId = id;
            var product_qty = $('#qty-input-' + rowId).val();
            var token = "{{ csrf_token() }}";
            var path = "{{ route('cart.update') }}";

            $.ajax({
                url: path,
                type: 'POST',
                data: {
                    _token: token,
                    product_qty: product_qty,
                    rowId: rowId,
                    productQuantity: productQuantity,
                },
                success: function(data) {
                    $('body #header-ajax').html(data['header']);
                    $('body #cart-counter').html(data['cart_count']);
                    $('body #cart-list').html(data['cart_list']);

                    if (data['status']) {
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
                        toastr.success(data['message']);
                    } else {
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
                        toastr.warning(data['message']);
                    }
                },
                error: function(err) {
                    toastr.error("Something went wrong!, please try again later");
                }
            });
        }
    </script>
@endsection
