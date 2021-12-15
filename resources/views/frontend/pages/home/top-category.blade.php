<div class="top_catagory_area mt-50 clearfix">
    <div class="container">
        <div class="row">
            <!-- Single Catagory -->
            @forelse ($categories as $cat)
            <div class="col-12 col-md-4">
                <div class="single_catagory_area mt-50">
                    <a href="{{ route('product.category', $cat->slug) }}">
                        <img src="{{ $cat->photo }}" alt="{{ $cat->title }}">
                    </a>
                </div>
            </div>
            @empty

            @endforelse

        </div>
    </div>
</div>
