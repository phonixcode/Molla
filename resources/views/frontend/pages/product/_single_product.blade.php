<div class="single-product-area mb-30">
    <div class="product_image">
        <!-- Product Image -->
        @php
            $photo=explode(',',$item->photo);
        @endphp
        <img class="normal_img" src="{{ $photo[0] }}" alt="{{ $item->title }}" />
        {{-- <img class="hover_img" src="frontend/img/product-img/new-1.png" alt=""> --}}

        <!-- Product Badge -->
        <div class="product_badge">
            <span>{{ $item->stock > 0 ? $item->condition : 'Out of Stock'}}</span>
        </div>

        <!-- Wishlist -->
        <div class="product_wishlist">
            <a href="javascript:void(0);" class="add_to_wishlist" data-quantity="1" data-id="{{ $item->id }}" id="add_to_wishlist_{{ $item->id }}">
                <i class="icofont-heart"></i>
            </a>
        </div>

        <!-- Compare -->
        <div class="product_compare">
            <a href="compare.html"><i class="icofont-exchange"></i></a>
        </div>
    </div>

    <!-- Product Description -->
    <div class="product_description">
        <!-- Add to cart -->

        <div class="product_add_to_cart">
            <a href="javascript:void(0);" data-quantity="1" data-product-id="{{ $item->id }}"
                class="add_to_cart {{ $item->stock > 0 ? '' : 'deactivate' }}" id="add_to_cart{{ $item->id }}">
                <i class="icofont-shopping-cart"></i> {{ $item->stock > 0 ? 'Add to Cart' : 'Out of Stock' }}
            </a>
        </div>

        <!-- Quick View -->
        <div class="product_quick_view">
            <a href="#" data-toggle="modal" data-target="#quickview"><i
                    class="icofont-eye-alt"></i>
                Quick View</a>
        </div>

        <p class="brand_name">{{ $item->brands[0]['title'] }}</p>
        <a href="{{ route('product.details', $item->slug) }}">{{ ucfirst($item->title) }}</a>
        <h6 class="product-price">
            ${{ number_format($item->offer_price,2) }}
            @if ($item->discount > 0)
            <small><del class="text-danger">${{ number_format($item->price,2) }}</del></small>
            @endif
        </h6>
    </div>
</div>
