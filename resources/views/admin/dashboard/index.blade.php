@extends('admin.layouts.master')

@section('content')
    <div class="app-main" id="main">
        <!-- begin container-fluid -->

        <div class="container-fluid">
            <!-- begin row -->
            <div class="row">
                <div class="col-md-12 m-b-30">
                    <!-- begin page title -->
                    <div class="d-block d-sm-flex flex-nowrap align-items-center">
                        <div class="page-title mb-2 mb-sm-0">
                            <h1>Dashboard</h1>
                        </div>
                    </div>
                    <!-- end page title -->
                </div>
            </div>
            <!-- end row -->

            <!-- start dashboard contant -->
            <div class="row">
                <div class="col-lg-12 col-xxl-3">
                    <div class="row">
                        <div class="col-3">
                            <div class="card card-statistics">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="media">
                                                <i class="fa fa-suitcase text-pink font-60 mr-4"></i>
                                                <div class="media-body pb-0">
                                                    <h4 class="mb-1">{{ count($products) }}</h4>
                                                    <p>Total Products</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card card-statistics">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="media">
                                                <i class="fa fa-sitemap text-info font-60 mr-4"></i>
                                                <div class="media-body pb-0">
                                                    <h4 class="mb-1">{{ count($categories) }}</h4>
                                                    <p>Total Categories</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card card-statistics">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="media">
                                                <i class="fa fa-group text-warning font-60 mr-4"></i>
                                                <div class="media-body pb-0">
                                                    <h4 class="mb-1">{{ count($users) }}</h4>
                                                    <p>New Customers</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card card-statistics">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="media">
                                                <i class="fa fa-money text-success font-60 mr-4"></i>
                                                <div class="media-body pb-0">
                                                    <h4 class="mb-1">$0.00</h4>
                                                    <p>Net Profile</p>
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

            {{-- <div class="row">
                <div class="col-xxl-6 m-b-30">
                    <div class="card card-statistics h-100 m-b-0">
                        <div class="card-header d-flex justify-content-between">
                            <div class="card-heading">
                                <h4 class="card-title">Income analysis</h4>
                            </div>
                            <div class="dropdown">
                                <a class="p-2" href="#!" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fe fe-more-horizontal"></i>
                                </a>
                                <div class="dropdown-menu custom-dropdown dropdown-menu-right p-4">
                                    <h6 class="mb-1">Action</h6>
                                    <a class="dropdown-item" href="#!"><i class="fa-fw fa fa-file-o pr-2"></i>View reports</a>
                                    <a class="dropdown-item" href="#!"><i class="fa-fw fa fa-edit pr-2"></i>Edit reports</a>
                                    <a class="dropdown-item" href="#!"><i class="fa-fw fa fa-bar-chart-o pr-2"></i>Statistics</a>
                                    <h6 class="mb-1 mt-3">Export</h6>
                                    <a class="dropdown-item" href="#!"><i class="fa-fw fa fa-file-pdf-o pr-2"></i>Export to PDF</a>
                                    <a class="dropdown-item" href="#!"><i class="fa-fw fa fa-file-excel-o pr-2"></i>Export to CSV</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-xxs-6 col-md-4">
                                    <h5 class="mb-1 text-pink">Sale income</h5>
                                    <p>18% High Then Last Month</p>
                                </div>
                                <div class="col-xxs-6 col-md-4">
                                    <h5 class="mb-1 text-primary">Rent income</h5>
                                    <p>26% High Then Last Month</p>
                                </div>
                            </div>
                            <div class="apexchart-wrapper">
                                <div id="realestatedemo1" class="chart-fit"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-6 m-b-30">
                    <div class="card card-statistics h-100 mb-0">
                        <div class="card-header">
                            <h4 class="card-title">Revenue overview</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xs-6 mb-3 mb-xs-0">
                                    <h2>3.8k</h2>
                                    <span class="d-block mb-2 font-16">AVG months</span>
                                    <span class="d-block mb-5"><b class="text-primary">-65.88%</b> vs last 1 months</span>
                                    <p class="mb-3">Sapiente corporis fugiat, doloremque eveniet nostrum id molestiae quaerat!</p>
                                    <a class="btn btn-round btn-inverse-primary" href="#"><b>View details </b></a>
                                </div>
                                <div class="col-xs-6">
                                    <div class="apexchart-wrapper">
                                        <div id="realestatedemo3" class="chart-fit"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="border-top my-4"></div>
                            <h4 class="card-title">Income by department</h4>
                            <div class="row">
                                <div class="col-12 col-xs-3">
                                    <span>Purchases: <b>$1,475</b></span>
                                    <div class="progress my-3" style="height: 4px;">
                                        <div class="progress-bar" role="progressbar" style="width: 80%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-12 col-xs-3">
                                    <span>Sells: <b>$23,475</b></span>
                                    <div class="progress my-3" style="height: 4px;">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 66%;" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-12 col-xs-3">
                                    <span>Rented: <b>$1,658</b></span>
                                    <div class="progress my-3" style="height: 4px;">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 78%;" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-12 col-xs-3">
                                    <span>Leased: <b>$12,489</b></span>
                                    <div class="progress my-3" style="height: 4px;">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 55%;" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            <div class="row">
                <div class="col-xxl-8 m-b-30">
                    <div class="card card-statistics h-100 m-b-0">
                        <div class="card-header d-flex justify-content-between">
                            <div class="card-heading">
                                <h4 class="card-title">Recently Orders</h4>
                            </div>
                            <div class="dropdown">
                                <a class="btn btn-warning btn-sm" href="{{ route('order.index') }}">
                                    View all
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-borderless mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Product</th>
                                            <th>Date</th>
                                            <th>Payment Method</th>
                                            <th>Order Status</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-muted mb-0">
                                        @forelse ($orders as $item)
                                        <tr>
                                            <td>{{ $item->order_number }}</td>
                                            <td>{{ count($item->products) }}</td>
                                            <td>{{ Carbon\Carbon::parse($item->created_at)->isoFormat('MMMM Do YYYY') }}</td>
                                            <td>
                                                {{ $item->payment_method == 'cod' ? 'Cash on Delivery' : $item->payment_method }}
                                            </td>
                                            <td class="font-weight-bold {{ $item->payment_status == 'paid' ? 'text-success' : 'text-danger' }}">{{ ucfirst($item->payment_status) }}</td>
                                            <td>${{ number_format($item->total_amount,2) }}</td>
                                            <td>
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
                                                    {{ $item->condition }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('order.show', $item->uuid) }}" class="ml-2 btn btn-icon btn-sm btn-inverse-dark">
                                                    <i class="fa fa-desktop" data-toggle="tooltip" data-placement="top" title="" data-original-title="show"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @empty
                                            <tr>
                                                <td>No Orders</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end dashboard contant -->
        </div>
        <!-- end container-fluid -->
    </div>
@endsection

@section('script')
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
