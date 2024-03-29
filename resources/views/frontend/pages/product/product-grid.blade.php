@extends('frontend.layouts.master')

@section('content')
    <!-- Breadcumb Area -->
    <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>Shop</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Product</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <section class="shop_grid_area section_padding_100">
        <div class="container">
            <form action="{{ route('product.filter') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-12 col-sm-5 col-md-4 col-lg-3">
                        <div class="shop_sidebar_area">
                            <!-- Single Widget -->
                            <div class="widget catagory mb-30">
                                <h6 class="widget-title">Product Categories</h6>
                                <div class="widget-desc">
                                    <!-- Single Checkbox -->
                                    @if (!empty($_GET['category']))
                                        @php
                                            $filter_cats = explode(',', $_GET['category']);
                                        @endphp
                                    @endif
                                    @forelse ($categories as $cat)
                                        <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                            <input type="checkbox" @if (!empty($filter_cats) && in_array($cat->slug, $filter_cats)) checked @endif class="custom-control-input"
                                                id="{{ $cat->slug }}" name="category[]" onchange="this.form.submit()"
                                                value="{{ $cat->slug }}">
                                            <label class="custom-control-label"
                                                for="{{ $cat->slug }}">{{ $cat->title }}
                                                <span class="text-muted">({{ count($cat->products) }})</span>
                                            </label>
                                        </div>
                                    @empty
                                        <p>No product categories</p>
                                    @endforelse
                                </div>
                            </div>

                            <!-- Single Widget -->
                            <div class="widget price mb-30">
                                <h6 class="widget-title">Filter by Price</h6>
                                <div class="widget-desc">
                                    <div class="slider-range">
                                        <div id="slider-range" data-min="{{ Helper::minPrice() }}"
                                            data-max="{{ Helper::maxPrice() }}" data-unit="$"
                                            class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"
                                            data-value-min="{{ Helper::minPrice() }}"
                                            data-value-max="{{ Helper::maxPrice() }}" data-label-result="Price:">
                                            <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                                            <span class="ui-slider-handle ui-state-default ui-corner-all"
                                                tabindex="0"></span>
                                            <span class="ui-slider-handle ui-state-default ui-corner-all"
                                                tabindex="0"></span>
                                        </div>

                                        @if (!empty($_GET['price']))
                                            @php
                                                $price = explode('-', $_GET['price']);
                                            @endphp
                                        @endif

                                        <input type="hidden" id="price_range"
                                            value="{{ !empty($_GET['price']) ? $_GET['price'] : '' }}"
                                            name="price_range">
                                        {{-- <div class="range-price">Price: {{ Helper::minPrice() }} -
                                            {{ Helper::maxPrice() }}</div> --}}
                                        <input style="border: 0; width: 50%; margin-top: 18px;" type="text" id="amount" readonly
                                            value="${{ !empty($_GET['price']) ? $price[0] : Helper::minPrice() }} - ${{ !empty($_GET['price']) ? $price[1] : Helper::maxPrice() }}" />
                                        <button type="submit" class="btn btn-primary btn-sm my-4">filter</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Single Widget -->
                            <div class="widget brands mb-30">
                                <h6 class="widget-title">Filter by brands</h6>
                                <div class="widget-desc">
                                    @if (!empty($_GET['brand']))
                                        @php
                                            $filter_brands = explode(',', $_GET['brand']);
                                        @endphp
                                    @endif
                                    <!-- Single Checkbox -->
                                    @forelse ($brands as $brand)
                                        <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                            <input type="checkbox" @if (!empty($filter_brands) && in_array($brand->slug, $filter_brands)) checked @endif class="custom-control-input"
                                                id="{{ $brand->slug }}" name="brand[]" onchange="this.form.submit()"
                                                value="{{ $brand->slug }}">
                                            <label class="custom-control-label"
                                                for="{{ $brand->slug }}">{{ $brand->title }}<span
                                                    class="text-muted">
                                                    ({{ count($brand->products) }})</span></label>
                                        </div>
                                    @empty
                                        <p>No brands</p>
                                    @endforelse

                                </div>
                            </div>

                            <!-- Single Widget -->
                            <div class="widget size mb-30">
                                <h6 class="widget-title">Filter by Size</h6>
                                <div class="widget-desc">
                                    <!-- Single Checkbox -->
                                    <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                        <input type="checkbox" @if (!empty($_GET['size']) && $_GET['size'] == 'S')
                                        checked
                                        @endif
                                        class="custom-control-input" id="small" name="size" value="S"
                                        onchange="this.form.submit();">
                                        <label class="custom-control-label" for="small">Small <span
                                                class="text-muted">({{ \App\Models\Product::where(['status' => 'active', 'size' => 'S'])->count() }})</span>
                                        </label>
                                    </div>
                                    <!-- Single Checkbox -->
                                    <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                        <input type="checkbox" @if (!empty($_GET['size']) && $_GET['size'] == 'M')
                                        checked
                                        @endif
                                        class="custom-control-input" id="medium" name="size" value="M"
                                        onchange="this.form.submit();">
                                        <label class="custom-control-label" for="medium">Medium <span
                                                class="text-muted">({{ \App\Models\Product::where(['status' => 'active', 'size' => 'M'])->count() }})</span>
                                        </label>
                                    </div>
                                    <!-- Single Checkbox -->
                                    <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                        <input type="checkbox" @if (!empty($_GET['size']) && $_GET['size'] == 'L')
                                        checked
                                        @endif
                                        class="custom-control-input" id="large" name="size" value="L"
                                        onchange="this.form.submit();">
                                        <label class="custom-control-label" for="large">Large <span
                                                class="text-muted">({{ \App\Models\Product::where(['status' => 'active', 'size' => 'L'])->count() }})</span>
                                        </label>
                                    </div>
                                    <!-- Single Checkbox -->
                                    <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                        <input type="checkbox" @if (!empty($_GET['size']) && $_GET['size'] == 'XL')
                                        checked
                                        @endif
                                        class="custom-control-input" id="extra-large" name="size" value="XL"
                                        onchange="this.form.submit();">
                                        <label class="custom-control-label" for="extra-large">Extra Large <span
                                                class="text-muted">({{ \App\Models\Product::where(['status' => 'active', 'size' => 'XL'])->count() }})</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-7 col-md-8 col-lg-9">
                        <!-- Shop Top Sidebar -->
                        <div class="shop_top_sidebar_area d-flex flex-wrap align-items-center justify-content-between">
                            <div class="view_area d-flex">
                                <div class="grid_view">
                                    <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Grid View"><i
                                            class="icofont-layout"></i></a>
                                </div>
                                <div class="list_view ml-3">
                                    <a href="{{ route('product.list') }}" data-toggle="tooltip" data-placement="top" title="List View"><i
                                            class="icofont-listine-dots"></i></a>
                                </div>
                            </div>
                            <select id="sortBy" name="sortBy" onchange="this.form.submit();" class="small right">
                                <option selected>Default Sort</option>
                                <option value="newest"
                                    {{ !empty($_GET['sortBy']) && $_GET['sortBy'] == 'newest' ? ' selected' : '' }}>
                                    Sort by Newest
                                </option>
                                <option value="priceAsc"
                                    {{ !empty($_GET['sortBy']) && $_GET['sortBy'] == 'priceAsc' ? ' selected' : '' }}>
                                    Sort by Price - Lower To Higher
                                </option>
                                <option value="priceDesc"
                                    {{ !empty($_GET['sortBy']) && $_GET['sortBy'] == 'priceDesc' ? ' selected' : '' }}>
                                    Sort by Price - Higher To Lower
                                </option>
                                <option value="discAsc"
                                    {{ !empty($_GET['sortBy']) && $_GET['sortBy'] == 'discAsc' ? ' selected' : '' }}>
                                    Sort by Discount - Lower To Higher
                                </option>
                                <option value="discDesc"
                                    {{ !empty($_GET['sortBy']) && $_GET['sortBy'] == 'discDesc' ? ' selected' : '' }}>
                                    by Discount - Higher To Lower
                                </option>
                                <option value="titleAsc"
                                    {{ !empty($_GET['sortBy']) && $_GET['sortBy'] == 'titleAsc' ? ' selected' : '' }}>
                                    Sort Alphabetical Ascending
                                </option>
                                <option value="titleDesc"
                                    {{ !empty($_GET['sortBy']) && $_GET['sortBy'] == 'titleDesc' ? ' selected' : '' }}>
                                    Sort Alphabetical Descending
                                </option>
                            </select>
                        </div>

                        <p>Total : {{ $products->total() }}</p>
                        <div class="shop_grid_product_area">
                            <div class="row justify-content-center">
                                <!-- Single Product -->
                                @forelse ($products as $item)
                                    <div class="col-9 col-sm-12 col-md-6 col-lg-4">
                                        @include('frontend.pages.product._single_product', ['item' => $item])
                                    </div>
                                @empty
                                    <p>No product found.</p>
                                @endforelse
                            </div>
                        </div>

                        <!-- Shop Pagination Area -->
                        <div class="shop_pagination_area mt-30">
                            {{ $products->appends($_GET)->links('vendor.pagination.product-pagination') }}
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            if ($('#slider-range').length > 0) {
                const max_value = parseInt($("#slider-range").data('max')) || 500;
                const min_value = parseInt($("#slider-range").data('min')) || 0;
                const currency = $("#slider-range").data('currency') || '';
                let price_range = min_value + '-' + max_value;
                if ($("#price_range").length > 0 && $("#price_range").val()) {
                    price_range = $("#price_range").val().trim();
                }

                let price = price_range.split('-');
                $("#slider-range").slider({
                    range: true,
                    min: min_value,
                    max: max_value,
                    values: price,
                    slide: function(event, ui) {
                        $("#amount").val('$' + ui.values[0] + " -  " + '$' + ui.values[1]);
                        $("#price_range").val(ui.values[0] + "-" + ui.values[1]);
                    }
                });
            }
        });
    </script>
@endsection
