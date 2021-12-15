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
                            <h1>Add Product</h1>
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
                                    <li class="breadcrumb-item active text-warning" aria-current="page">Add Product</li>
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

            <!-- begin row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card card-statistics">
                        <div class="card-body">
                            <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" placeholder="Title" name="title"
                                        value="{{ old('title') }}">
                                </div>
                                <div class="form-group">
                                    <label for="summary">Summary</label>
                                    <textarea class="form-control summernote" id="summary" placeholder="Write some text..."
                                        name="summary">{{ old('summary') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control summernote" id="description" placeholder="Write some text..."
                                        name="description">{{ old('description') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="stock">Stock <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="stock" placeholder="Stock" name="stock"
                                        value="{{ old('stock') }}">
                                </div>
                                <div class="form-group">
                                    <label for="price">Price <span class="text-danger">*</span></label>
                                    <input type="number" step="any" class="form-control" id="price" placeholder="Price"
                                        name="price" value="{{ old('price') }}">
                                </div>
                                <div class="form-group">
                                    <label for="discount">Discount</label>
                                    <input type="number" min="0" max="100" step="any" class="form-control" id="discount"
                                        placeholder="Discount" name="discount" value="{{ old('discount') }}">
                                </div>
                                <div class="form-group">
                                    <label>Choose Image</label>
                                    <div class="input-group">
                                        <span class="input-group-append">
                                            <a id="photo" data-input="thumbnail" data-preview="holder"
                                                class="btn btn-warning text-white">
                                                <i class="fa fa-picture-o"></i> Upload
                                            </a>
                                        </span>
                                        <input id="thumbnail" class="form-control file-upload-info"
                                            placeholder="Choose Image" type="text" name="photo"
                                            value="{{ old('photo') }}">
                                    </div>
                                    <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                                </div>
                                <div class="form-group">
                                    <label>Size Guide</label>
                                    <div class="input-group">
                                        <span class="input-group-append">
                                            <a id="size-guide" data-input="thumbnail1" data-preview="holder1"
                                                class="btn btn-warning text-white">
                                                <i class="fa fa-picture-o"></i> Upload
                                            </a>
                                        </span>
                                        <input id="thumbnail1" class="form-control file-upload-info"
                                            placeholder="Choose Image" type="text" name="size_guide"
                                            value="{{ old('size_guide') }}">
                                    </div>
                                    <div id="holder1" style="margin-top:15px;max-height:100px;"></div>
                                </div>
                                <div class="form-group">
                                    <label for="brands">Brands</label>
                                    <select class="form-control" name="brand_id">
                                        <option value="">--- Brands ---</option>
                                        @foreach (\App\Models\Brand::get() as $brand)
                                            <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Category</label>
                                    <select id="cat_id" name="cat_id" class="form-control">
                                        <option value="">--- Category ---</option>
                                        @foreach (\App\Models\Category::where('is_parent', 1)->get() as $cat)
                                            <option value="{{ $cat->id }}" {{ old('cat_id') == $cat->id ? ' selected' : '' }}>{{ $cat->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group d-none" id="child_cat_div">
                                    <label for="">Child Category</label>
                                    <select id="child_cat_id" name="child_cat_id" class="form-control"></select>
                                </div>
                                <div class="form-group">
                                    <label for="size">Size</label>
                                    <select class="form-control" name="size">
                                        <option value="">--- Size ---</option>
                                        <option value="S" {{ old('size') == 'S' ? ' selected' : '' }}>
                                            Small
                                        </option>
                                        <option value="M" {{ old('size') == 'M' ? ' selected' : '' }}>
                                            Meduim
                                        </option>
                                        <option value="L" {{ old('size') == 'L' ? ' selected' : '' }}>
                                            Large
                                        </option>
                                        <option value="XL" {{ old('size') == 'XL' ? ' selected' : '' }}>
                                            Extra Large
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Conditions</label>
                                    <select class="form-control" name="condition">
                                        <option value="">--- Conditions ---</option>
                                        <option value="new" {{ old('new') == 'new' ? ' selected' : '' }}>
                                            New
                                        </option>
                                        <option value="popular" {{ old('popular') == 'popular' ? ' selected' : '' }}>
                                            Popular
                                        </option>
                                        <option value="winter" {{ old('winter') == 'winter' ? ' selected' : '' }}>
                                            Winter
                                        </option>
                                    </select>
                                </div>
                                {{-- <div class="form-group">
                                    <label for="">Vendors</label>
                                    <select class="form-control" name="seller_id">
                                        <option value="">--- vendors ---</option>
                                        @foreach (\App\Models\User::where('role', 'seller')->get() as $seller)
                                            <option value="{{ $seller->id }}" {{ old('vendor_id') == $seller->id ? ' selected' : '' }}>{{ $seller->full_name }}</option>
                                        @endforeach
                                    </select>
                                </div> --}}
                                <div class="form-group">
                                    <label for="additional_info">Additional Information</label>
                                    <textarea class="form-control summernote" id="additional_info" placeholder="Write some text..."
                                        name="additional_info">{{ old('additional_info') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="return_cancellation">Retrun & Cancellation</label>
                                    <textarea class="form-control summernote" id="return_cancellation" placeholder="Write some text..."
                                        name="return_cancellation">{{ old('return_cancellation') }}</textarea>
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
        $('#photo, #size-guide').filemanager('image');
    </script>

    <script>
        $(document).ready(function() {
            $('.summernote').summernote();
        });
    </script>
    <script>
        $('#cat_id').change(function() {
            var cat_id = $(this).val();
            //alert(cat_id);
            if (cat_id != null) {
                $.ajax({
                    url: "/admin/category/" + cat_id + "/child",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        cat_id: cat_id,
                    },
                    success: function(response) {
                        var html_option = "<option value=''>--- Child Category ---</option>";
                        if (response.status) {
                            $('#child_cat_div').removeClass('d-none');
                            $.each(response.data, function(id, title) {
                                html_option += "<option value='" + id + "'>" + title +
                                    "</option>"
                            });
                        } else {
                            $('#child_cat_div').addClass('d-none');
                        }
                        $('#child_cat_id').html(html_option);
                    }
                });
            }
        });
    </script>
@endsection
