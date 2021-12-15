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
                            <h1> Edit Currency</h1>
                        </div>
                        <div class="ml-auto d-flex align-items-center">
                            <nav>
                                <ol class="breadcrumb p-0 m-b-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('admin') }}"><i class="ti ti-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('currency.index') }}">Currencies</a>
                                    </li>
                                    <li class="breadcrumb-item active text-warning" aria-current="page">Edit Currency</li>
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
                            <form action="{{ route('currency.update', $currency->uuid) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <label for="name">Currency Name</label>
                                    <input type="text" class="form-control" id="name" placeholder="Name" name="name"
                                        value="{{ $currency->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="symbol">Symbol</label>
                                    <input type="text" class="form-control" id="symbol" placeholder="Symbol" name="symbol"
                                        value="{{ $currency->symbol }}">
                                </div>
                                <div class="form-group">
                                    <label for="exchange_rate">Exchange Rate</label>
                                    <input type="number" step="any" class="form-control" id="exchange_rate" placeholder="0.00" name="exchange_rate"
                                        value="{{ $currency->exchange_rate }}">
                                </div>
                                <div class="form-group">
                                    <label for="code">Symbol</label>
                                    <input type="text" class="form-control" id="code" placeholder="Code" name="code"
                                        value="{{ $currency->code }}">
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
