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
                            <h1> Edit Shipping Information</h1>
                        </div>
                        <div class="ml-auto d-flex align-items-center">
                            <nav>
                                <ol class="breadcrumb p-0 m-b-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('admin') }}"><i class="ti ti-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('shipping.index') }}">Shippings</a>
                                    </li>
                                    <li class="breadcrumb-item active text-warning" aria-current="page">Edit Shipping</li>
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
                    <div class="alert border-0 alert-danger m-b-30 alert-dismissible fade show border-radius-none" role="alert">
                        <ul class="text-white">
                            @foreach ($errors->all() as $error)
                                <li class="text-white">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
            </div>

            <!-- begin row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card card-statistics">
                        <div class="card-body">
                            <form action="{{ route('shipping.update', $shipping->uuid) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <label for="">Method <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" id="method" placeholder="Method" name="method"
                                        value="{{ $shipping->method }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Delivery Time <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" id="delivery_time" placeholder="Delivery Time" name="delivery_time"
                                        value="{{ $shipping->delivery_time }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Delivery Charge </label>
                                    <input type="number" step="any" class="form-control" id="delivery_charge" placeholder="Delivery Charge" name="delivery_charge"
                                        value="{{ $shipping->delivery_charge }}">
                                </div>
                                <button type="submit" class="btn btn-warning">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>

@endsection

@section('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('#lfm').filemanager('image');
    </script>

    <script>
        $(document).ready(function() {
            $('#description').summernote();
        })
    </script>
@endsection
