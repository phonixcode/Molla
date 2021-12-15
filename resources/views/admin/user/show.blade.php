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
                            <h3>User Profile</h3>
                        </div>
                        <div class="ml-auto d-flex align-items-center">
                            <nav>
                                <ol class="breadcrumb p-0 m-b-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('user.index') }}" class="btn btn-outline-dark btn-sm btn-icon-text">
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

            <div class="row">
                <div class="col-lg-12 col-xxl-3">
                    <div class="row">
                        <div class="col-4">
                            <div class="card card-statistics">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="media">
                                                <i class="fa fa-cart-plus text-info font-60 mr-4"></i>
                                                <div class="media-body pb-0">
                                                    <h4 class="mb-1">{{ !empty($user->orders_count) ? number_format($user->orders_count) : 0 }}</h4>
                                                    <p>Orders</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card card-statistics">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="media">
                                                <i class="fa fa-calendar-check-o text-info font-60 mr-4"></i>
                                                <div class="media-body pb-0">
                                                    <h4 class="mb-1">{{ !empty($user->completed_orders_count) ? number_format($user->completed_orders_count) : 0 }}</h4>
                                                    <p>Completed orders</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card card-statistics">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="media">
                                                <i class="fa fa-money text-info font-60 mr-4"></i>
                                                <div class="media-body pb-0">
                                                    <h4 class="mb-1">$0</h4>
                                                    <p>Total Amount Spend</p>
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

            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">Personal Infomation</div>
                        <div class="card-body">
                            <h4 class="card-title text-center">{{ $user->full_name }}</h4>
                            <table class="table table-sm mg-b-0">
                                <tbody>
                                    <tr>
                                        <td class="font-weight-bold" width="25%">Email</td>
                                        <td class="tx-color-03" width="75%">{{ $user->email }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold" width="25%">Phone</td>
                                        <td class="tx-color-03" width="75%">{{ $user->phone }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold" width="25%">Address</td>
                                        <td class="tx-color-03" width="75%">{{ $user->address }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold" width="25%">Date Joined</td>
                                        <td class="tx-color-03" width="75%">{{ Carbon\Carbon::parse($user->created_at)->isoFormat('MMMM Do YYYY, hh:mm:ssa') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="card card-statistics">
                        <div class="card-header">Orders as of {{ date('M, d Y') }}</div>
                        <div class="card-body">
                            <div class="datatable-wrapper table-responsive">
                                <table id="datatable" class="display compact table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>S.N.</th>
                                            <th>Order ID</th>
                                            <th>Payment Method</th>
                                            <th>Order Status</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($user->orders as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="font-weight-bold">{{ $item->order_number }}</td>
                                            <td class="font-weight-bold">
                                                {{ $item->payment_method == 'cod' ? 'Cash on Delivery' : $item->payment_method }}
                                            </td>
                                            <td class="font-weight-bold {{ $item->payment_status == 'paid' ? 'text-success' : 'text-danger' }}">{{ ucfirst($item->payment_status) }}</td>
                                            <td class="font-weight-bold">${{ number_format($item->total_amount,2) }}</td>
                                            <td class="font-weight-bold">
                                                <span class="badge
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
                                                </span>
                                            </td>
                                            <td style="white-space: nowrap; width: 1%;">
                                                <a href="{{ route('order.show', $item->uuid) }}" class="ml-3 btn btn-icon btn-sm btn-inverse-info">
                                                    <i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="" data-original-title="Details"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>S.N.</th>
                                            <th>Order ID</th>
                                            <th>Payment Method</th>
                                            <th>Order Status</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
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
.gutters {
    margin-right: -8px;
    margin-left: -8px;
}
</style>
@endsection
