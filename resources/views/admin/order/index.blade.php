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
                            <h1>
                                Order List
                            </h1>
                        </div>
                        <div class="ml-auto d-flex align-items-center">
                            <nav>
                                <ol class="breadcrumb p-0 m-b-0">
                                    <li class="breadcrumb-item">
                                        Total Orders: {{ count($orders) }}
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
                <div class="col-lg-12">
                    <div class="card card-statistics">
                        <div class="card-body">
                            <div class="datatable-wrapper table-responsive">
                                <table id="datatable" class="display compact table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>S.N.</th>
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
                                    <tbody>
                                        @foreach ($orders as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
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
                                                    {{ ucfirst($item->condition) }}
                                                </span>
                                            </td>
                                            <td style="white-space: nowrap; width: 1%;">
                                                <a href="{{ route('order.show', $item->uuid) }}" class="ml-3 btn btn-icon btn-sm btn-inverse-dark">
                                                    <i class="fa fa-desktop" data-toggle="tooltip" data-placement="top" title="" data-original-title="Details"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>S.N.</th>
                                            <th>Order ID</th>
                                            <th>Customer</th>
                                            <th>Email</th>
                                            <th>Payment Method</th>
                                            <th>Order Status</th>
                                            <th>Total</th>
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
        <!-- end container-fluid -->
    </div>
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
