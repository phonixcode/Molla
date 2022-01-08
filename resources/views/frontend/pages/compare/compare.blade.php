@extends('frontend.layouts.master')

@section('content')
    <!-- Breadcumb Area -->
    <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>Compare</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Compare</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->


    <!-- Compare Area  -->
    <div class="compare_area section_padding_100 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="compare-list">
                        <div class="table-responsive" id="compare-list">
                            @include('frontend.pages.compare._compare_lists')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart Area End -->

@endsection

@section('script')
    <script>
        $(document).on('click', '.move-to-cart', function(e) {
            e.preventDefault();
            var rowId = $(this).data('id');
            var token = "{{ csrf_token() }}";
            var path = "{{ route('compare.move.cart') }}";

            $.ajax({
                url: path,
                type: 'POST',
                data: {
                    _token: token,
                    rowId: rowId,
                },
                beforeSend: function() {
                    $('#move-to-' + rowId).html(
                        '<i class="fa fa-spinner fa-spin"></i>');
                },
                // complete: function() {
                //     $('#move-to-' + rowId).html('Add to cart');
                // },
                success: function(data) {
                    if (data['status']) {
                        $('body #cart-counter').html(data['cart_count']);
                        $('body #wishlist-list').html(data['wishlist_list']);
                        $('body #compare-list').html(data['compare_list']);
                        $('body #header-ajax').html(data['header']);

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
                    } else {
                        toastr.warning('Something went wrong!, please try again later');
                    }
                },
                error: function(error) {
                    toastr.error("Something went wrong!, please try again later");
                }
            });
        });

        $(document).on('click', '.move-to-wishlist', function(e) {
            e.preventDefault();
            var rowId = $(this).data('id');
            var token = "{{ csrf_token() }}";
            var path = "{{ route('compare.move.wishlist') }}";

            $.ajax({
                url: path,
                type: 'POST',
                data: {
                    _token: token,
                    rowId: rowId,
                },
                beforeSend: function() {
                    $('#move-to-' + rowId).html(
                        '<i class="fa fa-spinner fa-spin"></i>');
                },
                // complete: function() {
                //     $('#move-to-' + rowId).html('Add to cart');
                // },
                success: function(data) {
                    if (data['status']) {
                        $('body #cart-counter').html(data['cart_count']);
                        $('body #wishlist-list').html(data['wishlist_list']);
                        $('body #compare-list').html(data['compare_list']);
                        $('body #header-ajax').html(data['header']);

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
                    } else {
                        toastr.warning('Something went wrong!, please try again later');
                    }
                },
                error: function(error) {
                    toastr.error("Something went wrong!, please try again later");
                }
            });
        });

        $(document).on('click', '.delete-compare', function(e) {
            e.preventDefault();
            var rowId = $(this).data('id');
            var token = "{{ csrf_token() }}";
            var path = "{{ route('compare.delete') }}";

            $.ajax({
                url: path,
                type: 'POST',
                data: {
                    _token: token,
                    rowId: rowId,
                },
                success: function(data) {
                    if (data['status']) {
                        $('body #cart-counter').html(data['cart_count']);
                        $('body #wishlist-list').html(data['wishlist_list']);
                        $('body #compare-list').html(data['compare_list']);
                        $('body #header-ajax').html(data['header']);

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
                    } else {
                        toastr.error('Error removing item from wishlist');
                    }
                },
                error: function(error) {
                    toastr.error("Something went wrong!, please try again later");
                }
            });
        });
    </script>
@endsection
