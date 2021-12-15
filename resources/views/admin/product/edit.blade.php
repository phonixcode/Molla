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
                        <h1>Edit Product</h1>
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
                                <li class="breadcrumb-item active text-warning" aria-current="page">Edit Product</li>
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
                        <form action="{{ route('product.update', $product->uuid) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" placeholder="Banner Title" name="title"
                                    value="{{ $product->title }}">
                            </div>
                            <div class="form-group">
                                <label for="summary">Summary</label>
                                <textarea class="form-control summernote" id="summary" rows="4" placeholder="Write some text..."
                                    name="summary">{{ $product->summary }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control summernote" id="description" rows="4" placeholder="Write some text..."
                                    name="description">{{ $product->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="stock">Stock <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="stock" placeholder="Stock" name="stock"
                                    value="{{ $product->stock }}">
                            </div>
                            <div class="form-group">
                                <label for="price">Price <span class="text-danger">*</span></label>
                                <input type="number" step="any" class="form-control" id="price" placeholder="Price"
                                    name="price" value="{{ $product->price }}">
                            </div>
                            <div class="form-group">
                                <label for="discount">Discount</label>
                                <input type="number" min="0" max="100" step="any" class="form-control" id="discount"
                                    placeholder="Discount" name="discount" value="{{ $product->discount }}">
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
                                        type="text" name="photo" value="{{ $product->photo }}">
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
                                        value="{{ $product->size_guide }}">
                                </div>
                                <div id="holder1" style="margin-top:15px;max-height:100px;"></div>
                            </div>
                            <div class="form-group">
                                <label for="brands">Brands</label>
                                <select class="form-control" name="brand_id">
                                    <option value="">--- Brands ---</option>
                                    @foreach (\App\Models\Brand::get() as $brand)
                                        <option value="{{ $brand->id }}" {{ $brand->id == $product->brand_id ? 'selected' : '' }}>{{ $brand->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Category</label>
                                <select id="cat_id" name="cat_id" class="form-control">
                                    <option value="">--- Category ---</option>
                                    @foreach (\App\Models\Category::where('is_parent', 1)->get() as $cat)
                                        <option value="{{ $cat->id }}" {{ $cat->id == $product->cat_id ? 'selected' : '' }}>{{ $cat->title }}</option>
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
                                    <option value="S" {{ $product->size == 'S' ? ' selected' : '' }}>
                                        Small
                                    </option>
                                    <option value="M" {{ $product->size == 'M' ? ' selected' : '' }}>
                                        Meduim
                                    </option>
                                    <option value="L" {{ $product->size == 'L' ? ' selected' : '' }}>
                                        Large
                                    </option>
                                    <option value="XL" {{ $product->size == 'XL' ? ' selected' : '' }}>
                                        Extra Large
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Conditions</label>
                                <select class="form-control" name="condition">
                                    <option value="">--- Conditions ---</option>
                                    <option value="new" {{ $product->condition == 'new' ? 'selected' : '' }}>
                                        New
                                    </option>
                                    <option value="popular" {{ $product->condition == 'popular' ? 'selected' : '' }}>
                                        Popular
                                    </option>
                                    <option value="winter" {{ $product->condition == 'winter' ? 'selected' : '' }}>
                                        Winter
                                    </option>
                                </select>
                            </div>
                            {{-- <div class="form-group">
                                <label for="">Vendors</label>
                                <select class="form-control" name="vendor_id">
                                    <option value="">--- vendors ---</option>
                                    @foreach (\App\Models\User::where('role', 'seller')->get() as $seller)
                                        <option value="{{ $seller->id }}" {{ $seller->id == $product->seller_id ? 'selected' : '' }}>{{ $seller->full_name }}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                            <div class="form-group">
                                <label for="additional_info">Additional Information</label>
                                <textarea class="form-control summernote" id="additional_info" placeholder="Write some text..."
                                    name="additional_info">{{ $product->additional_info }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="return_cancellation">Retrun & Cancellation</label>
                                <textarea class="form-control summernote" id="return_cancellation" placeholder="Write some text..."
                                    name="return_cancellation">{{ $product->return_cancellation }}</textarea>
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
        $('#lfm, #size-guide').filemanager('image');
    </script>

    <script>
        $(document).ready(function() {
            $('.summernote').summernote();
        })
    </script>

    <script>
        var child_cat_id = {{ $product->child_cat_id }};
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
                                html_option += "<option value='" + id + "' "+(child_cat_id == id ? 'selected' : '')+">" + title +
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
        if(child_cat_id != null){
            $('#cat_id').change();
        }
    </script>
@endsection
