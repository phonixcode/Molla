@extends('frontend.layouts.master')

@section('content')
    <!-- Breadcumb Area -->
    <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>My Account</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">My Account</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <!-- My Account Area -->
    <section class="my-account-area section_padding_100_50">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-3">
                    @include('frontend.user._includes.sidebar')
                </div>
                <div class="col-12 col-lg-9">
                    <div class="my-account-content mb-50">
                        <div class="cart-table">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">Order ID</th>
                                            <th scope="col">Product</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Payment Method</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Total</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($user->orders as $item)
                                        <tr>
                                            <th scope="row">
                                                {{ $item->order_number }}
                                            </th>
                                            <td>
                                                {{ count($item->products) }}
                                            </td>
                                            <td>
                                                {{ Carbon\Carbon::parse($item->created_at)->isoFormat('MMMM Do YYYY') }}
                                            </td>
                                            <td>
                                                {{ $item->payment_method == 'cod' ? 'Cash on Delivery' : $item->payment_method }}
                                            </td>
                                            <td>
                                                <p class="badge
                                                    @if($item->condition == 'pending')
                                                    badge-info
                                                    @elseif ($item->condition == 'processing')
                                                    badge-primary
                                                    @elseif ($item->condition == 'delivered')
                                                    badge-success
                                                    @else
                                                    badge-danger
                                                    @endif
                                                    ">
                                                    {{ ucfirst($item->condition) }}
                                                </p>
                                            </td>
                                            <td>${{ number_format($item->total_amount, 2) }}</td>
                                            <td>
                                                <a href="javascript:void(0)" class="m-2" data-toggle="modal" data-target="#orderInfo{{ $item->id }}"><i class="fa fa-desktop"></i></a>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7">You have not order any product!</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- My Account Area -->

    @foreach ($user->orders as $item)
    <div class="modal fade" id="orderInfo{{ $item->id }}" tabindex="-1" role="dialog"
        aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Order Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="row justify-content-md-center gutters">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="invoice-container">
                                    <div class="row gutters">
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                            <p class="badge
                                                @if($item->condition == 'pending')
                                                badge-info
                                                @elseif ($item->condition == 'processing')
                                                badge-primary
                                                @elseif ($item->condition == 'delivered')
                                                badge-success
                                                @else
                                                badge-danger
                                                @endif
                                                ">
                                                {{ ucfirst($item->condition) }}
                                            </p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <h3 class="text-right text-warning">{{ $item->order_number }}</h3>
                                        </div>
                                    </div>
                                    <div class="spacer30"></div>
                                    <div class="row gutters">
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <p class="font-weight-bold">{{ $item->first_name . ' ' . $item->last_name }}</p>
                                            <p class="text-warning">{{ $item->email }}</p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <p class="text-right">ORDER: <span class="text-warning">{{ $item->order_number }}</span></p>
                                            <p class="text-right"><small> {{ Carbon\Carbon::parse($item->created_at)->isoFormat('MMMM Do YYYY, hh:mm:ssa') }}</small></p>
                                        </div>
                                    </div>
                                    <div class="spacer50"></div>
                                    <div class="row gutters">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="table-responsive">
                                                <table class="display compact table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>S.N</th>
                                                            <th>Product Image</th>
                                                            <th>Product Name</th>
                                                            <th>Discount</th>
                                                            <th>Quantity</th>
                                                            <th>Price</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($item->products as $product)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>
                                                                @php
                                                                    $photo = explode(',', $product->photo);
                                                                @endphp
                                                                <img src="{{ $photo[0] }}" alt="" width="50"
                                                                height="50">
                                                            </td>
                                                            <td>{{ $product->title }}</td>
                                                            <td>
                                                                {{ $product->discount }}%
                                                            </td>
                                                            <td>
                                                                {{ $product->pivot->quantity }}
                                                            </td>
                                                            <td>${{ number_format($product->price,2) }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row gutters">
                                        <div class="col-lg-6 col-md-6 col-sm-12">

                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <table class="table plain">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <p class="text-right">Subtotal</p>
                                                            <p class="text-right">Shipping Cost</p>
                                                            @if ($item->coupon > 0)
                                                            <p class="text-right">Coupon</p>
                                                            @endif
                                                            <p class="text-right text-warning"><strong>Grand Total</strong></p>
                                                        </td>
                                                        <td>
                                                            <p class="text-right">${{ number_format($item->sub_total,2) }}</p>
                                                            <p class="text-right">${{ number_format($item->delivery_charge,2) }}</p>
                                                            @if ($item->coupon > 0)
                                                            <p class="text-right">${{ number_format($item->coupon,2) }}</p>
                                                            @endif
                                                            <p class="text-right text-warning ml-3"><strong>${{ number_format($item->total_amount,2) }}</strong></p>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="spacer20"></div>

                                    <div class="row gutters">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <p class="text-uppercase">
                                                <strong>Billing Information</strong>
                                            </p>
                                            <address>
                                                <strong>{{ $item->first_name . ' ' . $item->last_name }}</strong><br>
                                                <strong>Address:</strong> {{ $item->address }}<br>
                                                <strong>Tel:</strong> {{ $item->phone }}<br>
                                            </address>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-7"></div>
                                        <div class="col-5">
                                            <div class="table-responsive" style="margin-left: -20px;">
                                                <table class="display compact table table-bordered">
                                                    <tr>
                                                        <th>Payment method</th>
                                                        <td>{{ $item->payment_method == 'cod' ? 'Cash on Delivery' : $item->payment_method }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Payment Status</th>
                                                        <td class="font-weight-bold {{ $item->payment_status == 'paid' ? 'text-success' : 'text-danger' }}">{{ ucfirst($item->payment_status) }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

@endsection
