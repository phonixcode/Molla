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
                            <h1> Edit Coupon </h1>
                        </div>
                        <div class="ml-auto d-flex align-items-center">
                            <nav>
                                <ol class="breadcrumb p-0 m-b-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('admin') }}"><i class="ti ti-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('coupon.index') }}">Coupons</a>
                                    </li>
                                    <li class="breadcrumb-item active text-warning" aria-current="page">Edit Coupon</li>
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
                            <form action="{{ route('coupon.update', $coupon->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <label for="">Coupon Code <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="code" placeholder="Coupon code" name="code"
                                        value="{{ $coupon->code }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Coupon Value <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="value" placeholder="Coupon value" name="value"
                                        value="{{ $coupon->value }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Coupon Type</label>
                                    <select class="form-control" name="type">
                                        <option value="">--- Coupon Type ---</option>
                                        <option value="fixed" {{ $coupon->type == 'fixed' ? ' selected' : '' }}>Fixed
                                        </option>
                                        <option value="percent" {{ $coupon->type == 'percent' ? ' selected' : '' }}>Percentage
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" name="status">
                                        <option value="active" {{ $coupon->status == 'active' ? ' selected' : '' }}>
                                            Active
                                        </option>
                                        <option value="inactive" {{ $coupon->status == 'inactive' ? ' selected' : '' }}>
                                            Inactive
                                        </option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-warning">Update</button>
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
