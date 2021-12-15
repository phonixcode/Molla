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
                            <h1>Add Category</h1>
                        </div>
                        <div class="ml-auto d-flex align-items-center">
                            <nav>
                                <ol class="breadcrumb p-0 m-b-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('admin') }}"><i class="ti ti-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('category.index') }}">Categories</a>
                                    </li>
                                    <li class="breadcrumb-item active text-warning" aria-current="page">Add Category</li>
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
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
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
                            <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" placeholder="Title" name="title"
                                        value="{{ old('title') }}">
                                </div>
                                <div class="form-group">
                                    <label for="summary">Summary</label>
                                    <textarea class="form-control" id="summary" placeholder="Write some text..."
                                        name="summary">{{ old('summary') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="is_parent">Is Parent: </label>
                                    <div class="form-check">
                                        <input type="checkbox" id="is_parent" type="checkbox" class="form-check-input" name="is_parent" value="1" checked>
                                        <label class="form-check-label" for="is_parent">YES</label>
                                    </div>
                                </div>
                                <div class="form-group d-none" id="parent_cat_div">
                                    <label for="parent_id">Parent Category</label>
                                    <select class="form-control" name="parent_id">
                                        <option value="">--- Parent Category ---</option>
                                        @foreach ($parent_cats as $pcats)
                                        <option value="{{ $pcats->id }}" {{ old('parent_id') == $pcats->id ? 'selected' : '' }}>{{ $pcats->title }}</option>
                                        @endforeach
                                    </select>
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
                                            type="text" name="photo" value="{{ old('photo') }}">
                                    </div>
                                    <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" name="status">
                                        <option value="active" {{ old('status') == 'active' ? ' selected' : '' }}>
                                            Active
                                        </option>
                                        <option value="inactive" {{ old('status') == 'inactive' ? ' selected' : '' }}>
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

    <script>
        $(document).ready(function() {
            $('#summary').summernote();
        })
    </script>

    <script>
        $('#is_parent').change(function(e) {
            e.preventDefault();
            var is_checked = $('#is_parent').prop('checked');
            if(is_checked) {
                $('#parent_cat_div').addClass('d-none');
                $('#parent_cat_div').val('');
            }else{
                $('#parent_cat_div').removeClass('d-none');
            }
        })
    </script>
@endsection
