@extends('frontend.layouts.master')

@section('content')
    <!-- Breadcumb Area -->
    <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>Product</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">{{ $categories->title }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <section class="shop_grid_area section_padding_100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Shop Top Sidebar -->
                    <div class="shop_top_sidebar_area d-flex flex-wrap align-items-center justify-content-between">
                        <div class="view_area d-flex">
                            <div class="grid_view">
                                <a href="shop-grid-left-sidebar.html" data-toggle="tooltip" data-placement="top"
                                    title="Grid View"><i class="icofont-layout"></i></a>
                            </div>
                            <div class="list_view ml-3">
                                <a href="shop-list-left-sidebar.html" data-toggle="tooltip" data-placement="top"
                                    title="List View"><i class="icofont-listine-dots"></i></a>
                            </div>
                        </div>
                        <select id="sortBy" class="small right">
                            <option selected>Default Sort</option>
                            <option value="newest">Sort by Newest</option>
                            <option value="priceAsc">Sort by Price - Lower To Higher</option>
                            <option value="priceDesc">Sort by Price - Higher To Lower</option>
                            <option value="discAsc">Sort by Discount - Lower To Higher</option>
                            <option value="discDesc">Sort by Discount - Higher To Lower</option>
                            <option value="titleAsc">Sort Alphabetical Ascending</option>
                            <option value="titleDesc">Sort Alphabetical Descending</option>
                        </select>
                    </div>

                    <div class="shop_grid_product_area">
                        <div class="row justify-content-center">
                            <!-- Single Product -->
                            @forelse ($sort_products as $item)
                                <div class="col-9 col-sm-6 col-md-4 col-lg-3">
                                    @include('frontend.pages.product._single_product', ['item' => $item])
                                </div>
                            @empty
                                <p>No Product</p>
                            @endforelse

                        </div>
                    </div>

                    <!-- Shop Pagination Area -->
                    <div class="shop_pagination_area mt-30">
                        {{ $sort_products->links('vendor.pagination.product-pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $('#sortBy').change(function() {
            var sort = $('#sortBy').val();
            window.location = "{{ url('' . $route . '') }}/{{ $categories->slug }}?sort=" + sort;
        });
    </script>
@endsection
