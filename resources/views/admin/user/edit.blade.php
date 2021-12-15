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
                        <h1>Edit User</h1>
                    </div>
                    <div class="ml-auto d-flex align-items-center">
                        <nav>
                            <ol class="breadcrumb p-0 m-b-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin') }}"><i class="ti ti-home"></i></a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('user.index') }}">Users</a>
                                </li>
                                <li class="breadcrumb-item active text-warning" aria-current="page">Edit User</li>
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
                        <form action="{{ route('user.update', $user->uuid) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="">Full_Name</label>
                                <input type="text" class="form-control" id="full_name" placeholder="Enter Full Name" name="full_name"
                                    value="{{ $user->full_name }}">
                            </div>
                            <div class="form-group">
                                <label for="">Username</label>
                                <input type="text" class="form-control" id="username" placeholder="Enter Username" name="username"
                                    value="{{ $user->username }}">
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" class="form-control" id="email" placeholder="Enter Email" name="email"
                                    value="{{ $user->email }}">
                            </div>
                            <div class="form-group">
                                <label for="">Phone</label>
                                <input type="text" class="form-control" id="phone" placeholder="Enter Phone" name="phone"
                                    value="{{ $user->phone }}">
                            </div>
                            <div class="form-group">
                                <label for="">Address</label>
                                <input type="text" class="form-control" id="address" placeholder="Enter Address" name="address"
                                    value="{{ $user->address }}">
                            </div>
                            <div class="form-group">
                                <label>Choose Image</label>
                                <div class="input-group">
                                    <span class="input-group-append">
                                        <a id="lfm" data-input="thumbnail" data-preview="holder"
                                            class="btn btn-warning text-white">
                                            <i class="fa fa-picture-o"></i> Upload
                                        </a>
                                    </span>
                                    <input id="thumbnail" class="form-control file-upload-info"
                                        placeholder="Choose Image" type="text" name="photo"
                                        value="{{ $user->photo }}">
                                </div>
                                <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                            </div>
                            <div class="form-group">
                                <label for="">Role</label>
                                <select class="form-control" name="role">
                                    <option value="">--- Role ---</option>
                                    <option value="admin" {{ $user->role == 'admin' ? ' selected' : '' }}>
                                        Admin
                                    </option>
                                    <option value="seller" {{ $user->role == 'seller' ? ' selected' : '' }}>
                                        Seller
                                    </option>
                                    <option value="customer" {{ $user->role == 'customer' ? ' selected' : '' }}>
                                        Customer
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" name="status">
                                    <option value="active" {{ $user->status == 'active' ? ' selected' : '' }}>
                                        Active
                                    </option>
                                    <option value="inactive" {{ $user->status == 'inactive' ? ' selected' : '' }}>
                                        Inactive
                                    </option>
                                </select>
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
@endsection
