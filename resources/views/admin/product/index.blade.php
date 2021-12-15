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
                                Products
                                <a href="{{ route('product.create') }}" class="btn btn-outline-warning btn-icon-text">
                                    <i class="fa fa-plus-square"></i>
                                    create new product
                                </a>
                            </h1>
                        </div>
                        <div class="ml-auto d-flex align-items-center">
                            <nav>
                                <ol class="breadcrumb p-0 m-b-0">
                                    <li class="breadcrumb-item">
                                        Total Products: {{ count($products) }}
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
                                <table id="datatable" class="display compact table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>S.N.</th>
                                            <th>Title</th>
                                            <th>Photo</th>
                                            <th>Price</th>
                                            <th>Discount</th>
                                            <th>Size</th>
                                            <th>Conditions</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->title }}</td>
                                                <td>
                                                    @php
                                                        $photo = explode(',', $item->photo);
                                                    @endphp
                                                    <img src="{{ $photo[0] }}" alt="{{ $item->title }}" width="50"
                                                        height="50" />
                                                </td>
                                                <td>${{ number_format($item->price, 2) }}</td>
                                                <td>{{ $item->discount }}%</td>
                                                <td>{{ $item->size }}</td>
                                                <td>
                                                    @if ($item->condition == 'new')
                                                        <span
                                                            class="badge badge-success-inverse">{{ $item->condition }}</span>
                                                    @elseif ($item->condition == 'popular')
                                                        <span
                                                            class="badge badge-warning-inverse">{{ $item->condition }}</span>
                                                    @else
                                                        <span
                                                            class="badge badge-primary-inverse">{{ $item->condition }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="toggle" value="{{ $item->id }}" {{ $item->status == 'active' ? 'checked' : '' }} data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger" data-size="sm">
                                                </td>
                                                <td style="white-space: nowrap; width: 1%;">
                                                    <div class="dropdown">
                                                        <button class="btn btn-warning btn-sm dropdown-toggle" type="button"
                                                            id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            Options
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                            <a href="{{ route('product.attribute', $item->uuid) }}"
                                                                class="dropdown-item">
                                                                <i class="fa fa-plus-circle pr-2 text-dark"></i>Add Attribute
                                                            </a>
                                                            <a href="{{ route('product.show', $item->uuid) }}"
                                                                class="dropdown-item">
                                                                <i class="fe fe-file-text pr-2 text-warning"></i>Details
                                                            </a>
                                                            <a href="{{ route('product.edit', $item->uuid) }}"
                                                                class="dropdown-item">
                                                                <i class="ti ti-pencil pr-2 text-primary"></i>Edit
                                                            </a>
                                                            <form action="{{ route('product.destroy', $item->uuid) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('delete')
                                                                <a class="dltBtn dropdown-item"
                                                                    href="{{ route('product.destroy', $item->uuid) }}"
                                                                    data-id="{{ $item->uuid }}">
                                                                    <i class="ti ti-trash pr-2 text-danger"></i>Delete
                                                                </a>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>S.N.</th>
                                            <th>Title</th>
                                            <th>Photo</th>
                                            <th>Price</th>
                                            <th>Discount</th>
                                            <th>Size</th>
                                            <th>Conditions</th>
                                            <th>Status</th>
                                            <th>Actions</th>
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

    <script>
        $('input[name=toggle]').change(function() {
            var mode = $(this).prop('checked');
            var id = $(this).val();
            $.ajax({
                url: "{{ route('product.status') }}",
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    mode: mode,
                    id: id,
                },
                success: function(response) {
                    if (response.status) {
                        toastr.success(response.msg);
                    } else {
                        toastr.error("Some went wrong!, please try again");
                    }
                }
            })
        });
    </script>
@endsection
