@extends('admin.layouts.master')

@section('content')
    <div class="app-main" id="main">
        <div class="container-fluid">
            <!-- begin row -->
            <div class="row">
                <div class="col-md-12 m-b-30">
                    <!-- begin page title -->
                    <div class="d-block d-sm-flex flex-nowrap align-items-center">
                        <div class="page-title mb-2 mb-sm-0">
                            <h1>Product Details</h1>
                        </div>
                        <div class="ml-auto d-flex align-items-center">
                            <nav>
                                <ol class="breadcrumb p-0 m-b-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('product.index') }}" class="btn btn-outline-dark btn-sm btn-icon-text">
                                            <i class="ti ti-arrow-left pr-1"></i>
                                            Back
                                        </a>
                                        <a href="{{ route('product.edit', $product->uuid) }}" class="btn btn-outline-primary btn-sm btn-icon-text">
                                            <i class="ti ti-pencil pr-1"></i>
                                            Edit
                                        </a>
                                    </li>
                                    {{-- <li class="breadcrumb-item active text-primary" aria-current="page">Product Details</li> --}}
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <!-- end page title -->
                </div>
            </div>
            <!-- end row -->

            <!-- begin row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-statistics mb-30">
                        <div class="col-md-6 mt-3">
                            <img class="card-img-top" src="{{ $product->photo }}"
                                alt="Card image cap">
                        </div>
                        <div class="card-body">
                            <p class="card-text"><b>Name:</b> {{ $product->title }}</p>
                            <p class="card-text"><b>Summary: </b> {!! html_entity_decode($product->summary) !!}</p>
                            <p class="card-text"><b>Description: </b> {!! html_entity_decode($product->description) !!}</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><b>Price:</b> ${{ number_format($product->price, 2) }}</li>
                            <li class="list-group-item"><b>Offer Price:</b> ${{ number_format($product->offer_price, 2) }}
                            <li class="list-group-item"><b>Stock:</b> {{ $product->stock }}</li>
                            <li class="list-group-item"><b>Discount:</b> {{ $product->discount }}%</li>
                            <li class="list-group-item"><b>Category:</b>
                                {{ \App\Models\Category::where('id', $product->cat_id)->value('title') }}
                            </li>
                            <li class="list-group-item"><b>Child Category:</b>
                                {{ \App\Models\Category::where('id', $product->child_cat_id)->value('title') }}
                            </li>
                            <li class="list-group-item"><b>Brand:</b>
                                {{ \App\Models\Brand::where('id', $product->brand_id)->value('title') }}
                            </li>
                            <li class="list-group-item"><b>Size:</b>
                                <p class="badge badge-warning-inverse">{{ $product->size }}</p>
                            </li>
                            {{-- <li class="list-group-item"><b>Vendor:</b>
                                {{ \App\Models\User::where('id', $product->vendor_id)->value('full_name') }}
                            </li> --}}
                            <li class="list-group-item"><b>Condition:</b>
                                @if ($product->condition == 'new')
                                    <span class="badge badge-success-inverse">{{ $product->condition }}</span>
                                @elseif ($product->condition == 'popular')
                                    <span class="badge badge-warning-inverse">{{ $product->condition }}</span>
                                @else
                                    <span class="badge badge-primary-inverse">{{ $product->condition }}</span>
                                @endif
                            </li>
                            <li class="list-group-item"><b>Status:</b>
                                @if ($product->status == 'active')
                                    <span class="badge badge-success">{{ $product->status }}</span>
                                @else
                                    <span class="badge badge-danger">{{ $product->status }}</span>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
