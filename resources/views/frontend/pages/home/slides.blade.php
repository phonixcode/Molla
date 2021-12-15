@if (count($banners) > 0)
    <section class="welcome_area">
        <div class="welcome_slides owl-carousel">
            <!-- Single Slide -->
            @foreach ($banners as $banner)
                <div class="single_slide bg-img" style="background-image: url({{ $banner->photo }});">
                    <div class="container h-100">
                        <div class="row h-100 align-items-center">
                            <div class="col-7 col-md-8">
                                <div class="welcome_slide_text">
                                    <h2 data-animation="fadeInUp" data-delay="300ms">{{ $banner->title }}</h2>
                                    <h4 data-animation="fadeInUp" data-delay="600ms">{!! html_entity_decode($banner->description) !!}</h4>
                                    <a href="{{ $banner->slug }}" class="btn btn-primary" data-animation="fadeInUp" data-delay="1s">Buy
                                        Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endif
