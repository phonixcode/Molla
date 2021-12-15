<div class="container">
    <div class="row justify-content-between">
        <div class="col-12">
            <div class="cart-table">
                <div class="table-responsive" >
                    <table class="table table-bordered mb-30">
                        <thead>
                            <tr>
                                <th scope="col"><i class="icofont-ui-delete"></i></th>
                                <th scope="col">Image</th>
                                <th scope="col">Product</th>
                                <th scope="col">Unit Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach (Cart::instance('shopping')->content() as $item)
                                <tr>
                                    <th scope="row" data-id="{{ $item->rowId }}" class="delete-cart-item">
                                        <i class="icofont-close"></i>
                                    </th>
                                    <td>
                                        <img src="{{ $item->model->photo }}" alt="{{ $item->name }}">
                                    </td>
                                    <td>
                                        <a
                                            href="{{ route('product.details', $item->model->slug) }}">{{ $item->name }}</a>
                                    </td>
                                    <td>${{ number_format($item->price, 2) }}</td>
                                    <td>
                                        <div class="quantity">
                                            <input type="number" data-id="{{ $item->rowId }}"
                                                class="qty-text" id="qty-input-{{ $item->rowId }}" step="1"
                                                min="1" max="99" name="quantity" value="{{ $item->qty }}">
                                            <input type="hidden" data-id="{{ $item->rowId }}"
                                                data-product-quantity="{{ $item->model->stock }}"
                                                id="update-cart-{{ $item->rowId }}">
                                        </div>
                                    </td>
                                    <td>${{ $item->subtotal() }}</td>
                                </tr>
                            @endforeach --}}

                            @forelse (Cart::instance('shopping')->content() as $item)
                            <tr>
                                <th scope="row" data-id="{{ $item->rowId }}" class="delete-cart-item">
                                    <i class="icofont-close"></i>
                                </th>
                                <td>
                                    @php
                                        $photo = explode(',', $item->model->photo);
                                    @endphp
                                    <img src="{{ $photo[0] }}" alt="{{ $item->name }}" style="width: 50px; height: 50px;">
                                </td>
                                <td>
                                    <a
                                        href="{{ route('product.details', $item->model->slug) }}">{{ $item->name }}</a>
                                </td>
                                <td>${{ number_format($item->price, 2) }}</td>
                                <td>
                                    <div class="quantity">
                                        <input type="number" data-id="{{ $item->rowId }}"
                                            class="qty-text" id="qty-input-{{ $item->rowId }}" step="1"
                                            min="1" max="99" name="quantity" value="{{ $item->qty }}">
                                        <input type="hidden" data-id="{{ $item->rowId }}"
                                            data-product-quantity="{{ $item->model->stock }}"
                                            id="update-cart-{{ $item->rowId }}">
                                    </div>
                                </td>
                                <td>${{ $item->subtotal() }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6">You don't have any product available in your cart.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="cart-apply-coupon mb-30">
                <h6>Have a Coupon?</h6>
                <p>Enter your coupon code here &amp; get awesome discounts!</p>
                <!-- Form -->
                <div class="coupon-form">
                    <form action="{{ route('coupon.add') }}" method="post" id="coupon-form">
                        @csrf
                        <input type="text" class="form-control" name="code"
                            placeholder="Enter Your Coupon Code">
                        <button type="submit" class="coupon-btn btn btn-primary">Apply Coupon</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-5">
            <div class="cart-total-area mb-30">
                <h5 class="mb-3">Cart Totals</h5>
                <div class="table-responsive">
                    <table class="table mb-3">
                        <tbody>
                            <tr>
                                <td>Sub Total</td>
                                <td>${{ Cart::subtotal() }}</td>
                            </tr>
                            @if (session()->has('coupon'))
                            <tr>
                                <td>Coupon</td>
                                <td>${{ session()->has('coupon') ? number_format(session()->get('coupon')['value'], 2) : 0 }}</td>
                            </tr>
                            @endif
                            <tr>
                                @php
                                    $subtotal = floatval(implode(explode(',',Cart::subtotal())));
                                @endphp
                                <td>Total</td>
                                <td>${{ session()->has('coupon') ? number_format($subtotal - session()->get('coupon')['value'], 2) : number_format($subtotal,2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <a href="{{ route('checkout.one') }}" class="btn btn-primary d-block">Proceed To Checkout</a>
            </div>
        </div>
    </div>
</div>
