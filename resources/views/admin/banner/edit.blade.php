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
                            <h1> Edit Banner</h1>
                        </div>
                        <div class="ml-auto d-flex align-items-center">
                            <nav>
                                <ol class="breadcrumb p-0 m-b-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('admin') }}"><i class="ti ti-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('banner.index') }}">Banners</a>
                                    </li>
                                    <li class="breadcrumb-item active text-warning" aria-current="page">Edit Banner</li>
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
                            <form action="{{ route('banner.update', $banner->slug) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" placeholder="Banner Title" name="title"
                                        value="{{ $banner->title }}">
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" rows="4" placeholder="Write some text..."
                                        name="description">{{ $banner->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Choose Image</label>
                                    <div class="input-group">
                                        <span class="input-group-append">
                                            <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-warning text-white">
                                                <i class="fa fa-picture-o"></i> Upload
                                            </a>
                                        </span>
                                        <input id="thumbnail" class="form-control file-upload-info" placeholder="Choose Image"
                                            type="text" name="photo" value="{{ $banner->photo }}">
                                    </div>
                                    <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                                </div>
                                <div class="form-group">
                                    <label for="condition">Condition</label>
                                    <select class="form-control" id="condition" name="condition">
                                        <option value="banner" {{ $banner->condition == 'banner' ? ' selected' : '' }}>
                                            Banner
                                        </option>
                                        <option value="promo" {{ $banner->condition == 'promo' ? ' selected' : '' }}>
                                            Promote
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
