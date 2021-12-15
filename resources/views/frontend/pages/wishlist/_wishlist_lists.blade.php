<table class="table table-bordered mb-30">
    <thead>
        <tr>
            <th scope="col"><i class="icofont-ui-delete"></i></th>
            <th scope="col">Image</th>
            <th scope="col">Product</th>
            <th scope="col">Unit Price</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @forelse (Cart::instance('wishlist')->content() as $item)
        <tr>
            <th scope="row">
                <i class="icofont-close delete-wishlist" data-id="{{ $item->rowId }}"></i>
            </th>
            <td>
                @php
                    $photo=explode(',',$item->model->photo);
                @endphp
                <img src="{{ $photo[0] }}" alt="{{ $item->name }}">
            </td>
            <td>
                <a
                    href="{{ route('product.details', $item->model->slug) }}">{{ $item->name }}</a>
            </td>
            <td>${{ number_format($item->price, 2) }}</td>
            <td>
                <a href="javascript:void(0);" data-id="{{ $item->rowId }}"
                    class="move-to-cart btn btn-primary btn-sm
                    {{ $item->model->stock > 0 ? '' : 'deactivate' }}"
                    id="move-to-{{ $item->rowId }}">
                    {{ $item->model->stock > 0 ? 'Add to Cart' : 'Out of Stock' }}
                </a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5">You don't have any wishlist product!</td>
        </tr>
        @endforelse
    </tbody>
</table>
