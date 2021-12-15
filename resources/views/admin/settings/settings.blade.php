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
                            Edit Settings
                        </h1>
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
                        <form action="{{ route('settings.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="title">Website Title</label>
                                <input type="text" class="form-control" id="title" placeholder="Title" name="title"
                                    value="{{ $setting->title }}">
                            </div>
                            <div class="form-group">
                                <label for="meta_keyword">Meta Keywords</label>
                                <input type="text" class="form-control" id="meta_keyword" placeholder="Meta Keyword" name="meta_keywords"
                                    value="{{ $setting->meta_keywords }}">
                            </div>
                            <div class="form-group">
                                <label for="meta_description">Meta Description</label>
                                <textarea class="form-control" id="meta_description" rows="5" placeholder="Write some text..."
                                    name="meta_description">{{ $setting->meta_description }}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>Logo</label>
                                        <div class="input-group">
                                            <span class="input-group-append">
                                                <a id="logo" data-input="thumbnail" data-preview="holder"
                                                    class="btn btn-warning text-white">
                                                    <i class="fa fa-picture-o"></i> Upload
                                                </a>
                                            </span>
                                            <input id="thumbnail" class="form-control file-upload-info"
                                                placeholder="Logo" type="text" name="logo"
                                                value="{{ $setting->logo }}">
                                        </div>
                                        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>Favicon</label>
                                        <div class="input-group">
                                            <span class="input-group-append">
                                                <a id="favicon" data-input="thumbnail1" data-preview="holder1"
                                                    class="btn btn-warning text-white">
                                                    <i class="fa fa-picture-o"></i> Upload
                                                </a>
                                            </span>
                                            <input id="thumbnail1" class="form-control file-upload-info"
                                                placeholder="Favicon" type="text" name="favicon"
                                                value="{{ $setting->favicon }}">
                                        </div>
                                        <div id="holder1" style="margin-top:15px;max-height:100px;"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="address">Address <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="address" placeholder="Address" name="address"
                                            value="{{ $setting->address }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="email">Email Address <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="email" placeholder="Email" name="email"
                                            value="{{ $setting->email }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="phone">Phone <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="phone" placeholder="Phone" name="phone"
                                            value="{{ $setting->phone }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="fax">Fax <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="fax" placeholder="Fax" name="fax"
                                            value="{{ $setting->fax }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="facebook_url">Facebook URL</label>
                                        <input type="text" class="form-control" id="facebook_url" placeholder="Facebook URL" name="facebook_url"
                                            value="{{ $setting->facebook_url }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="instagram_url">Instagram URL</label>
                                        <input type="text" class="form-control" id="instagram_url" placeholder="Instagram URL" name="instagram_url"
                                            value="{{ $setting->instagram_url }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="twitter_url">Twitter URL</label>
                                        <input type="text" class="form-control" id="twitter_url" placeholder="Twitter URL" name="twitter_url"
                                            value="{{ $setting->twitter_url }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="pinterest_url">Pinterest URL</label>
                                        <input type="text" class="form-control" id="pinterest_url" placeholder="Pinterest URL" name="pinterest_url"
                                            value="{{ $setting->pinterest_url }}">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-warning">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end container-fluid -->
</div>
@endsection
@section('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('#logo, #favicon').filemanager('image');
    </script>
@endsection
