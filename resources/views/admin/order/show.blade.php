@extends('admin.layouts.master')

@section('content')
<div class="app-main" id="main">
    <div class="container-fluid">
        <div class="row gutters">
            <div class="col-md-12 m-b-30">
                <!-- begin page title -->
                <div class="d-block d-sm-flex flex-nowrap align-items-center">

                    <div class="ml-auto d-flex align-items-center">
                        <nav>
                            <ol class="breadcrumb p-0 m-b-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('order.index') }}" class="btn btn-outline-dark btn-sm btn-icon-text">
                                        <i class="ti ti-arrow-left pr-1"></i>
                                        Back
                                    </a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!-- end page title -->
            </div>
        </div>
        <!-- end row -->

        <div class="row justify-content-md-center gutters">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="invoice-container">
                            <div class="row gutters">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                    <p class="badge
                                        @if($order->condition == 'pending')
                                        badge-info
                                        @elseif ($order->condition == 'processing')
                                        badge-primary
                                        @elseif ($order->condition == 'delivered')
                                        badge-success
                                        @else
                                        badge-danger
                                        @endif
                                        ">
                                        {{ ucfirst($order->condition) }}
                                    </p>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <h3 class="text-right text-warning">{{ $order->order_number }}</h3>
                                </div>
                            </div>
                            <div class="spacer30"></div>
                            <div class="row gutters">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <p class="font-weight-bold">{{ $order->first_name . ' ' . $order->last_name }}</p>
                                    <p class="text-warning">{{ $order->email }}</p>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <p class="text-right">ORDER: <span class="text-warning">{{ $order->order_number }}</span></p>
                                    <p class="text-right"><small> {{ Carbon\Carbon::parse($order->created_at)->isoFormat('MMMM Do YYYY, hh:mm:ssa') }}</small></p>
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
                                                @foreach ($order->products as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        @php
                                                            $photo = explode(',', $item->photo);
                                                        @endphp
                                                        <img src="{{ $photo[0] }}" alt="" width="50"
                                                        height="50">
                                                    </td>
                                                    <td>{{ $item->title }}</td>
                                                    <td>
                                                        {{ $item->discount }}%
                                                    </td>
                                                    <td>
                                                        {{ $item->pivot->quantity }}
                                                    </td>
                                                    <td>${{ number_format($item->price,2) }}</td>
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
                                                    @if ($order->coupon > 0)
                                                    <p class="text-right">Coupon</p>
                                                    @endif
                                                    <p class="text-right text-warning"><strong>Grand Total</strong></p>
                                                </td>
                                                <td>
                                                    <p class="text-right">${{ number_format($order->sub_total,2) }}</p>
                                                    <p class="text-right">${{ number_format($order->delivery_charge,2) }}</p>
                                                    @if ($order->coupon > 0)
                                                    <p class="text-right">${{ number_format($order->coupon,2) }}</p>
                                                    @endif
                                                    <p class="text-right text-warning ml-3"><strong>${{ number_format($order->total_amount,2) }}</strong></p>
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
                                        <strong>{{ $order->first_name . ' ' . $order->last_name }}</strong><br>
                                        <strong>Address:</strong> {{ $order->address }}<br>
                                        <strong>Tel:</strong> {{ $order->phone }}<br>
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
                                                <td>{{ $order->payment_method == 'cod' ? 'Cash on Delivery' : $order->payment_method }}</td>
                                            </tr>
                                            <tr>
                                                <th>Payment Status</th>
                                                <td class="font-weight-bold {{ $order->payment_status == 'paid' ? 'text-success' : 'text-danger' }}">{{ ucfirst($order->payment_status) }}</td>
                                            </tr>
                                            <tr>
                                                <th>Status</th>
                                                <td>
                                                    <form action="{{ route('order.status') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                                                        <select name="condition" id="" class="form-control"
                                                        {{ $order->condition == 'delivered' || $order->condition == 'cancelled'? 'disabled' : '' }}>
                                                            <option value="pending" {{ $order->condition == 'pending' ? 'selected' : '' }}>
                                                                Pending
                                                            </option>
                                                            <option value="processing" {{ $order->condition == 'processing' ? 'selected' : '' }}>
                                                                Processing
                                                            </option>
                                                            <option value="delivered" {{ $order->condition == 'delivered' ? 'selected' : '' }}>
                                                                Delivered
                                                            </option>
                                                            <option value="cancelled" {{ $order->condition == 'cancelled' ? 'selected' : '' }}>
                                                                Cancelled
                                                            </option>
                                                        </select>
                                                        <button class="mt-2 btn btn-sm btn-dark btn-block"
                                                        {{ $order->condition == 'delivered' || $order->condition == 'cancelled'? 'disabled' : '' }}>
                                                            Update
                                                        </button>
                                                    </form>
                                                </td>
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
@endsection

@section('style')
<style>
.invoice-container {
    background-color: rgb(255, 255, 255);
    padding: 1rem;
}
.gutters {
    margin-right: -8px;
    margin-left: -8px;
}
.spacer20 {
    height: 20px;
}
.spacer30 {
    height: 30px;
}
.spacer50 {
    height: 50px;
}
</style>
@endsection

@section('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="crsf-token"]').attr('content')
            }
        });
        $('.dltBtn').click(function(e) {
            var form = $(this).closest('form');
            var dataID = $(this).data('id');
            e.preventDefault();
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: true,
                reverseButtons: true
            }).then((willDelete) => {
                if (willDelete.value) {
                    form.submit();
                    swal(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your imaginary file is safe :)',
                        'error'
                    )
                }
            })
        });
    </script>
@endsection
