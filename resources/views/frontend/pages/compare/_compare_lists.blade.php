<table class="table table-bordered mb-0">
    <tbody>
        @if (Cart::instance('compare')->count() > 0)
        <tr>
            <td class="com-title">Product Image</td>
            @foreach (Cart::instance('compare')->content() as $item)
                @php
                    $photo = explode(',', $item->model->photo);
                @endphp
                <td class="com-pro-img">
                    <a href="#"><img src="{{ $photo[0] }}" alt="{{ $item->name }}"></a>
                </td>
            @endforeach
        </tr>
        <tr>
            <td class="com-title">Product Name</td>
            @foreach (Cart::instance('compare')->content() as $item)
                <td><a href="{{ route('product.details', $item->model->slug) }}">{{ ucfirst($item->name) }}</a></td>
            @endforeach
        </tr>
        <tr>
            <td class="com-title">Rating</td>
            @foreach (Cart::instance('compare')->content() as $item)
                @php
                    $rate = ceil($item->model->product_reviews->avg('rate'));
                @endphp

                <td>
                    <div class="rating">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($rate >= $i)
                                <i class="fa fa-star" aria-hidden="true"></i>
                            @else
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                            @endif
                        @endfor
                    </div>
                </td>
            @endforeach
        </tr>
        <tr>
            <td class="com-title">Price</td>
            @foreach (Cart::instance('compare')->content() as $item)
                <td>${{ number_format($item->price, 2) }}</td>
            @endforeach
        </tr>
        <tr>
            <td class="com-title">Description</td>
            @foreach (Cart::instance('compare')->content() as $item)
                <td>{!! nl2br($item->model->summary) !!}</td>
            @endforeach
        </tr>
        <tr>
            <td class="com-title">Category</td>
            @foreach (Cart::instance('compare')->content() as $item)
                <td>{{ $item->model->category['title'] }}</td>
            @endforeach
        </tr>
        <tr>
            <td class="com-title">Brand</td>
            @foreach (Cart::instance('compare')->content() as $item)
                <td>{{ $item->model->brand['title'] }}</td>
            @endforeach
        </tr>
        <tr>
            <td class="com-title">Availability</td>
            @foreach (Cart::instance('compare')->content() as $item)
                @if ($item->model->stock > 0)
                    <td class="instock">Instock</td>
                @else
                    <td class="outofstock">Out Of Stock</td>
                @endif
            @endforeach
        </tr>
        <tr>
            <td class="com-title"></td>
            @foreach (Cart::instance('compare')->content() as $item)
                <td class="action">
                    <a href="javascript:void(0)" data-id="{{ $item->rowId }}"
                        class="mb-1 compare_addTocart move-to-cart">
                        <i class="icofont-shopping-cart"></i>
                    </a>
                    <a href="javascript:void(0)" data-id="{{ $item->rowId }}"
                        class="mb-1 compare_addWishlist move-to-wishlist">
                        <i class="icofont-heart"></i>
                    </a>
                    <a href="javascript:void(0)" data-id="{{ $item->rowId }}"
                        class="mb-1 remove_from_compare delete-compare">
                        <i class="icofont-close"></i>
                    </a>
                </td>
            @endforeach
        </tr>
        @else
        <tr>
           <td align="center">No product found !</td>
        </tr>
        @endif
    </tbody>
</table>
