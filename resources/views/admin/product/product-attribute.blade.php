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
                                Product Attribute
                            </h1>
                        </div>
                        <div class="ml-auto d-flex align-items-center">
                            <nav>
                                <ol class="breadcrumb p-0 m-b-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('admin') }}"><i class="ti ti-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('product.index') }}">Products</a>
                                    </li>
                                    <li class="breadcrumb-item active text-warning" aria-current="page">Product Attribute
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
                <div class="col-md-12">
                    @if ($errors->any())
                        <div class="alert border-0 alert-danger m-b-30 alert-dismissible fade show border-radius-none"
                            role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-statistics">
                        <h2 style="margin-top: 1.2rem; margin-left: 1.2rem">{{ ucfirst($product->title) }}</h2>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <form action="{{ route('product.attribute.store', $product->uuid) }}" method="post">
                                        @csrf
                                        <div id="product-attribute" class="content"
                                            data-mfield-options='{"section": ".group", "btnAdd": "#btnAdd-1", "btnRemove": ".btnRemove"}'>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <button type="button" id="btnAdd-1" class="btn btn-warning"><i
                                                            class="fa fa-plus-circle"></i></button>
                                                </div>
                                            </div>
                                            <div class="row group">
                                                <div class="col-md-2">
                                                    <label for="" class="mt-3">Size</label>
                                                    <input type="text" name="size[]" class="form-control form-control-sm"
                                                        placeholder="e.g. size">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="" class="mt-3">Origin Price</label>
                                                    <input type="number" step="any" class="form-control form-control-sm"
                                                        name="original_price[]" placeholder="e.g. 1200">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="" class="mt-3">Offer Price</label>
                                                    <input type="number" step="any"  name="offer_price[]" class="form-control form-control-sm"
                                                        placeholder="e.g. 1200">
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="" class="mt-3">Stock</label>
                                                    <input type="number" class="form-control form-control-sm" name="stock[]"
                                                        placeholder="e.g. 4">
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button" class="btn btn-sm btn-danger btnRemove" style="
                                                        margin-top: 2.88rem;"><i class="fa fa-trash"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="mt-3 btn btn-warning">Submit</button>
                                    </form>
                                </div>
                                <div class="col-md-6">
                                    <div class="table-responsive">
                                        <table id="datatable" class="display compact table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Size</th>
                                                    <th>Original Price</th>
                                                    <th>Offer Price</th>
                                                    {{-- <th>Stock</th> --}}
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($product_attributes as $item)
                                                    <tr>
                                                        <td>{{ $item->size }}</td>
                                                        <td>$ {{ number_format($item->original_price, 2) }}</td>
                                                        <td>$ {{ number_format($item->offer_price, 2) }}</td>
                                                        <td style="white-space: nowrap; width: 1%;">

                                                            <form
                                                                action="{{ route('product.attribute.destroy', $item->uuid) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('delete')
                                                                <a href="{{ route('product.attribute.destroy', $item->uuid) }}"
                                                                    class="dltBtn btn btn-icon btn-sm btn-inverse-danger"><i
                                                                        class="ti ti-trash"></i></a>
                                                                {{-- <a class="dltBtn dropdown-item"
                                                                    href="{{ route('product.attribute.destroy', $item->uuid) }}"
                                                                    data-id="{{ $item->uuid }}">
                                                                    <i class="ti ti-trash pr-2 text-danger"></i>
                                                                </a> --}}
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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

    <script src="{{ asset('backend/assets/js/jquery.multifield.min.js') }}"></script>

    <script>
        $('#product-attribute').multifield();
    </script>

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
