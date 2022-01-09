@foreach ($featured_products as $item)
    <!-- Quick View Modal Area -->
    <div class="modal fade" id="quickview{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="quickview"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body">
                    <div class="quickview_body">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 col-lg-5">
                                    <div class="quickview_pro_img">
                                        @php
                                            $photo = explode(',', $item->photo);
                                        @endphp
                                        <img class="first_img" src="{{ $photo[0] }}"
                                            alt="{{ $item->title }}" />
                                        <div class="product_badge">
                                            <span>{{ $item->stock > 0 ? $item->condition : 'Out of Stock' }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-7">
                                    <div class="quickview_pro_des">
                                        <h4 class="title">{{ ucfirst($item->title) }}</h4>
                                        @php
                                            $rate = ceil($item->product_reviews->avg('rate'));
                                        @endphp
                                        <div class="top_seller_product_rating mb-15">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($rate >= $i)
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                @else
                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                @endif
                                            @endfor
                                        </div>
                                        <h5 class="price">
                                            ${{ number_format($item->offer_price, 2) }}
                                            @if ($item->discount > 0)
                                                <span
                                                    class="text-danger">${{ number_format($item->price, 2) }}</span>
                                            @endif
                                        </h5>
                                        <p>{!! $item->summary !!}</p>
                                        <a href="{{ route('product.details', $item->slug) }}">View Full Product
                                            Details</a>
                                    </div>
                                    <!-- Add to Cart Form -->
                                    <form class="cart">
                                        <div class="quantity">
                                            <input data-id="{{ $item->id }}" type="number" class="qty-text"
                                                id="qty2" step="1" min="1" max="12" name="quantity" value="1">
                                        </div>
                                        <button type="submit" name="addtocart"
                                            class="add_to_cart_button_details cart-submit"
                                            data-product_id={{ $item->id }} data-quantity="1"
                                            data-price={{ $item->offer_price }}
                                            id="add_to_cart_button_details_{{ $item->id }}">
                                            Add to cart
                                        </button>

                                        <!-- Wishlist -->
                                        <div class="modal_pro_wishlist">
                                            <a href="javascript:void(0);" class="add_to_wishlist" data-quantity="1"
                                                data-id="{{ $item->id }}"
                                                id="add_to_wishlist_{{ $item->id }}">
                                                <i class="icofont-heart"></i>
                                            </a>
                                        </div>
                                        <!-- Compare -->
                                        <div class="modal_pro_compare">
                                            <a href="javascript:void(0);" class="add_to_compare"
                                                data-id="{{ $item->id }}" id="add_to_compare_{{ $item->id }}">
                                                <i class="icofont-exchange"></i>
                                            </a>
                                        </div>
                                    </form>
                                    </form>
                                    {{-- <!-- Share -->
                            <div class="share_wf mt-30">
                                <p>Share with friends</p>
                                <div class="_icon">
                                    <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i></a>
                                </div>
                            </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Quick View Modal Area -->
@endforeach

@foreach ($new_products as $item)
    <!-- Quick View Modal Area -->
    <div class="modal fade" id="quickview{{ $item->id }}" tabindex="-1" role="dialog"
        aria-labelledby="quickview" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body">
                    <div class="quickview_body">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 col-lg-5">
                                    <div class="quickview_pro_img">
                                        @php
                                            $photo = explode(',', $item->photo);
                                        @endphp
                                        <img class="first_img" src="{{ $photo[0] }}"
                                            alt="{{ $item->title }}" />
                                        <div class="product_badge">
                                            <span>{{ $item->stock > 0 ? $item->condition : 'Out of Stock' }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-7">
                                    <div class="quickview_pro_des">
                                        <h4 class="title">{{ ucfirst($item->title) }}</h4>
                                        @php
                                            $rate = ceil($item->product_reviews->avg('rate'));
                                        @endphp
                                        <div class="top_seller_product_rating mb-15">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($rate >= $i)
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                @else
                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                @endif
                                            @endfor
                                        </div>
                                        <h5 class="price">
                                            ${{ number_format($item->offer_price, 2) }}
                                            @if ($item->discount > 0)
                                                <span
                                                    class="text-danger">${{ number_format($item->price, 2) }}</span>
                                            @endif
                                        </h5>
                                        <p>{!! $item->summary !!}</p>
                                        <a href="{{ route('product.details', $item->slug) }}">View Full Product
                                            Details</a>
                                    </div>
                                    <!-- Add to Cart Form -->
                                    <form class="cart">
                                        <div class="quantity">
                                            <input data-id="{{ $item->id }}" type="number" class="qty-text"
                                                id="qty2" step="1" min="1" max="12" name="quantity" value="1">
                                        </div>
                                        <button type="submit" name="addtocart"
                                            class="add_to_cart_button_details cart-submit"
                                            data-product_id={{ $item->id }} data-quantity="1"
                                            data-price={{ $item->offer_price }}
                                            id="add_to_cart_button_details_{{ $item->id }}">
                                            Add to cart
                                        </button>

                                        <!-- Wishlist -->
                                        <div class="modal_pro_wishlist">
                                            <a href="javascript:void(0);" class="add_to_wishlist" data-quantity="1"
                                                data-id="{{ $item->id }}"
                                                id="add_to_wishlist_{{ $item->id }}">
                                                <i class="icofont-heart"></i>
                                            </a>
                                        </div>
                                        <!-- Compare -->
                                        <div class="modal_pro_compare">
                                            <a href="javascript:void(0);" class="add_to_compare"
                                                data-id="{{ $item->id }}" id="add_to_compare_{{ $item->id }}">
                                                <i class="icofont-exchange"></i>
                                            </a>
                                        </div>
                                    </form>
                                    </form>
                                    {{-- <!-- Share -->
                            <div class="share_wf mt-30">
                                <p>Share with friends</p>
                                <div class="_icon">
                                    <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i></a>
                                </div>
                            </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Quick View Modal Area -->
@endforeach

@foreach ($top_products as $item)
    <!-- Quick View Modal Area -->
    <div class="modal fade" id="quickview{{ $item->id }}" tabindex="-1" role="dialog"
        aria-labelledby="quickview" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body">
                    <div class="quickview_body">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 col-lg-5">
                                    <div class="quickview_pro_img">
                                        @php
                                            $photo = explode(',', $item->photo);
                                        @endphp
                                        <img class="first_img" src="{{ $photo[0] }}"
                                            alt="{{ $item->title }}" />
                                        <div class="product_badge">
                                            <span>{{ $item->stock > 0 ? $item->condition : 'Out of Stock' }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-7">
                                    <div class="quickview_pro_des">
                                        <h4 class="title">{{ ucfirst($item->title) }}</h4>
                                        @php
                                            $rate = ceil($item->product_reviews->avg('rate'));
                                        @endphp
                                        <div class="top_seller_product_rating mb-15">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($rate >= $i)
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                @else
                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                @endif
                                            @endfor
                                        </div>
                                        <h5 class="price">
                                            ${{ number_format($item->offer_price, 2) }}
                                            @if ($item->discount > 0)
                                                <span
                                                    class="text-danger">${{ number_format($item->price, 2) }}</span>
                                            @endif
                                        </h5>
                                        <p>{!! $item->summary !!}</p>
                                        <a href="{{ route('product.details', $item->slug) }}">View Full Product
                                            Details</a>
                                    </div>
                                    <!-- Add to Cart Form -->
                                    <form class="cart">
                                        <div class="quantity">
                                            <input data-id="{{ $item->id }}" type="number" class="qty-text"
                                                id="qty2" step="1" min="1" max="12" name="quantity" value="1">
                                        </div>
                                        <button type="submit" name="addtocart"
                                            class="add_to_cart_button_details cart-submit"
                                            data-product_id={{ $item->id }} data-quantity="1"
                                            data-price={{ $item->offer_price }}
                                            id="add_to_cart_button_details_{{ $item->id }}">
                                            Add to cart
                                        </button>

                                        <!-- Wishlist -->
                                        <div class="modal_pro_wishlist">
                                            <a href="javascript:void(0);" class="add_to_wishlist" data-quantity="1"
                                                data-id="{{ $item->id }}"
                                                id="add_to_wishlist_{{ $item->id }}">
                                                <i class="icofont-heart"></i>
                                            </a>
                                        </div>
                                        <!-- Compare -->
                                        <div class="modal_pro_compare">
                                            <a href="javascript:void(0);" class="add_to_compare"
                                                data-id="{{ $item->id }}" id="add_to_compare_{{ $item->id }}">
                                                <i class="icofont-exchange"></i>
                                            </a>
                                        </div>
                                    </form>
                                    </form>
                                    {{-- <!-- Share -->
                            <div class="share_wf mt-30">
                                <p>Share with friends</p>
                                <div class="_icon">
                                    <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i></a>
                                </div>
                            </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Quick View Modal Area -->
@endforeach
@foreach ($best_rated_products as $item)
    <!-- Quick View Modal Area -->
    <div class="modal fade" id="quickview{{ $item->id }}" tabindex="-1" role="dialog"
        aria-labelledby="quickview" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body">
                    <div class="quickview_body">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 col-lg-5">
                                    <div class="quickview_pro_img">
                                        @php
                                            $photo = explode(',', $item->photo);
                                        @endphp
                                        <img class="first_img" src="{{ $photo[0] }}"
                                            alt="{{ $item->title }}" />
                                        <div class="product_badge">
                                            <span>{{ $item->stock > 0 ? $item->condition : 'Out of Stock' }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-7">
                                    <div class="quickview_pro_des">
                                        <h4 class="title">{{ ucfirst($item->title) }}</h4>
                                        @php
                                            $rate = ceil($item->product_reviews->avg('rate'));
                                        @endphp
                                        <div class="top_seller_product_rating mb-15">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($rate >= $i)
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                @else
                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                @endif
                                            @endfor
                                        </div>
                                        <h5 class="price">
                                            ${{ number_format($item->offer_price, 2) }}
                                            @if ($item->discount > 0)
                                                <span
                                                    class="text-danger">${{ number_format($item->price, 2) }}</span>
                                            @endif
                                        </h5>
                                        <p>{!! $item->summary !!}</p>
                                        <a href="{{ route('product.details', $item->slug) }}">View Full Product
                                            Details</a>
                                    </div>
                                    <!-- Add to Cart Form -->
                                    <form class="cart">
                                        <div class="quantity">
                                            <input data-id="{{ $item->id }}" type="number" class="qty-text"
                                                id="qty2" step="1" min="1" max="12" name="quantity" value="1">
                                        </div>
                                        <button type="submit" name="addtocart"
                                            class="add_to_cart_button_details cart-submit"
                                            data-product_id={{ $item->id }} data-quantity="1"
                                            data-price={{ $item->offer_price }}
                                            id="add_to_cart_button_details_{{ $item->id }}">
                                            Add to cart
                                        </button>

                                        <!-- Wishlist -->
                                        <div class="modal_pro_wishlist">
                                            <a href="javascript:void(0);" class="add_to_wishlist" data-quantity="1"
                                                data-id="{{ $item->id }}"
                                                id="add_to_wishlist_{{ $item->id }}">
                                                <i class="icofont-heart"></i>
                                            </a>
                                        </div>
                                        <!-- Compare -->
                                        <div class="modal_pro_compare">
                                            <a href="javascript:void(0);" class="add_to_compare"
                                                data-id="{{ $item->id }}" id="add_to_compare_{{ $item->id }}">
                                                <i class="icofont-exchange"></i>
                                            </a>
                                        </div>
                                    </form>
                                    </form>
                                    {{-- <!-- Share -->
                            <div class="share_wf mt-30">
                                <p>Share with friends</p>
                                <div class="_icon">
                                    <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i></a>
                                </div>
                            </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Quick View Modal Area -->
@endforeach
