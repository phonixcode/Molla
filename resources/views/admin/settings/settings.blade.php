@extends('admin.layouts.master')

@section('content')
    <div class="app-main" id="main">
        <!-- begin container-fluid -->
        <div class="container-fluid">
            <div class="row tab-content">
                <div class="col-xxl-6">
                    <div class="card card-statistics">
                        <div class="card-body">
                            <div class="tab nav-border-bottom">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active show" id="app-setting-tab" data-toggle="tab"
                                            href="#app-setting" role="tab" aria-controls="app-setting" aria-selected="true">
                                            APPLICATION SETTING
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="mail-config-tab" data-toggle="tab" href="#mail-config"
                                            role="tab" aria-controls="mail-config" aria-selected="false">
                                            MAIL CONFIGURATION
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="db-config-tab" data-toggle="tab" href="#db-config"
                                            role="tab" aria-controls="db-config" aria-selected="false">
                                            DATABASE CONFIGURATION
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade py-3 active show" id="app-setting" role="tabpanel"
                                        aria-labelledby="app-setting-tab">
                                        <form action="{{ route('settings.update') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('put')
                                            <div class="form-group">
                                                <label for="title">Website Title</label>
                                                <input type="text" class="form-control" id="title" placeholder="Title"
                                                    name="title" value="{{ $setting->title }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="meta_keyword">Meta Keywords</label>
                                                <input type="text" class="form-control" id="meta_keyword"
                                                    placeholder="Meta Keyword" name="meta_keywords"
                                                    value="{{ $setting->meta_keywords }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="meta_description">Meta Description</label>
                                                <textarea class="form-control" id="meta_description" rows="5"
                                                    placeholder="Write some text..."
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
                                                                <a id="favicon" data-input="thumbnail1"
                                                                    data-preview="holder1"
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
                                                        <label for="address">Address <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="address"
                                                            placeholder="Address" name="address"
                                                            value="{{ $setting->address }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="form-group">
                                                        <label for="email">Email Address <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="email"
                                                            placeholder="Email" name="email"
                                                            value="{{ $setting->email }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="form-group">
                                                        <label for="phone">Phone <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="phone"
                                                            placeholder="Phone" name="phone"
                                                            value="{{ $setting->phone }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="form-group">
                                                        <label for="fax">Fax <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="fax" placeholder="Fax"
                                                            name="fax" value="{{ $setting->fax }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="form-group">
                                                        <label for="facebook_url">Facebook URL</label>
                                                        <input type="text" class="form-control" id="facebook_url"
                                                            placeholder="Facebook URL" name="facebook_url"
                                                            value="{{ $setting->facebook_url }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="form-group">
                                                        <label for="instagram_url">Instagram URL</label>
                                                        <input type="text" class="form-control" id="instagram_url"
                                                            placeholder="Instagram URL" name="instagram_url"
                                                            value="{{ $setting->instagram_url }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="form-group">
                                                        <label for="twitter_url">Twitter URL</label>
                                                        <input type="text" class="form-control" id="twitter_url"
                                                            placeholder="Twitter URL" name="twitter_url"
                                                            value="{{ $setting->twitter_url }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="form-group">
                                                        <label for="pinterest_url">Pinterest URL</label>
                                                        <input type="text" class="form-control" id="pinterest_url"
                                                            placeholder="Pinterest URL" name="pinterest_url"
                                                            value="{{ $setting->pinterest_url }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-warning">Update</button>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade py-3" id="mail-config" role="tabpanel"
                                        aria-labelledby="mail-config-tab">
                                        <form action="{{ route('settings.mail.config') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('put')
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="form-group">
                                                        <input type="hidden" name="types[]" value="MAIL_DRIVER">
                                                        <label for="type">TYPE</label>
                                                        <select name="MAIL_DRIVER" id="" class="form-control"
                                                            onchange="checkMailDriver();">
                                                            <option value="sendmail"
                                                                {{ env('MAIL_DRIVER') == 'sendmail' ? ' selected' : '' }}>
                                                                SendMail
                                                            </option>
                                                            <option value="smtp"
                                                                {{ env('MAIL_DRIVER') == 'smtp' ? ' selected' : '' }}>
                                                                SMTP
                                                            </option>
                                                            <option value="mailgun"
                                                                {{ env('MAIL_DRIVER') == 'mailgun' ? ' selected' : '' }}>
                                                                Mailgun
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="smtp">
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-12">
                                                        <div class="form-group">
                                                            <label for="">MAIL HOST</label>
                                                            <input type="hidden" name="types[]" value="MAIL_HOST">
                                                            <input type="text" class="form-control" name="MAIL_HOST"
                                                                value="{{ env('MAIL_HOST') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-12">
                                                        <div class="form-group">
                                                            <label for="">MAIL PORT</label>
                                                            <input type="hidden" name="types[]" value="MAIL_PORT">
                                                            <input type="text" class="form-control" name="MAIL_PORT"
                                                                value="{{ env('MAIL_PORT') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-12">
                                                        <div class="form-group">
                                                            <label for="">MAIL USERNAME</label>
                                                            <input type="hidden" name="types[]" value="MAIL_USERNAME">
                                                            <input type="text" class="form-control" name="MAIL_USERNAME"
                                                                value="{{ env('MAIL_USERNAME') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-12">
                                                        <div class="form-group">
                                                            <label for="">MAIL PASSWORD</label>
                                                            <input type="hidden" name="types[]" value="MAIL_PASSWORD">
                                                            <input type="password" class="form-control"
                                                                name="MAIL_PASSWORD" value="{{ env('MAIL_PASSWORD') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-12">
                                                        <div class="form-group">
                                                            <label for="">MAIL ENCRYPTION</label>
                                                            <input type="hidden" name="types[]" value="MAIL_ENCRYPTION">
                                                            <input type="text" class="form-control" name="MAIL_ENCRYPTION"
                                                                value="{{ env('MAIL_ENCRYPTION') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-12">
                                                        <div class="form-group">
                                                            <label for="">MAIL FROM ADDRESS</label>
                                                            <input type="hidden" name="types[]" value="MAIL_FROM_ADDRESS">
                                                            <input type="text" class="form-control"
                                                                name="MAIL_FROM_ADDRESS"
                                                                value="{{ env('MAIL_FROM_ADDRESS') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="mailgun">
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-12">
                                                        <div class="form-group">
                                                            <label for="">MAILGUN DOMAIN</label>
                                                            <input type="hidden" name="types[]" value="MAILGUN_DOMAIN">
                                                            <input type="text" class="form-control" name="MAILGUN_DOMAIN"
                                                                value="{{ env('MAILGUN_DOMAIN') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-12">
                                                        <div class="form-group">
                                                            <label for="">MAILGUN SECRET</label>
                                                            <input type="hidden" name="types[]" value="MAILGUN_SECRET">
                                                            <input type="text" class="form-control" name="MAILGUN_SECRET"
                                                                value="{{ env('MAILGUN_SECRET') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-warning">Update</button>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade py-3" id="db-config" role="tabpanel"
                                        aria-labelledby="db-config-tab">
                                        <form action="{{ route('settings.db.config') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('put')
                                            <div class="row">
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="form-group">
                                                        <label for="">DB CONNECTION</label>
                                                        <input type="hidden" name="types[]" value="DB_CONNECTION">
                                                        <input type="text" class="form-control" name="DB_CONNECTION"
                                                            value="{{ env('DB_CONNECTION') }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="form-group">
                                                        <label for="">DB HOST</label>
                                                        <input type="hidden" name="types[]" value="DB_HOST">
                                                        <input type="text" class="form-control" name="DB_HOST"
                                                            value="{{ env('DB_HOST') }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="form-group">
                                                        <label for="">DB PORT</label>
                                                        <input type="hidden" name="types[]" value="DB_PORT">
                                                        <input type="text" class="form-control" name="DB_PORT"
                                                            value="{{ env('DB_PORT') }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="form-group">
                                                        <label for="">DB DATABASE</label>
                                                        <input type="hidden" name="types[]" value="DB_DATABASE">
                                                        <input type="text" class="form-control" name="DB_DATABASE"
                                                            value="{{ env('DB_DATABASE') }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="form-group">
                                                        <label for="">DB USERNAME</label>
                                                        <input type="hidden" name="types[]" value="DB_USERNAME">
                                                        <input type="text" class="form-control" name="DB_USERNAME"
                                                            value="{{ env('DB_USERNAME') }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="form-group">
                                                        <label for="">DB PASSWORD</label>
                                                        <input type="hidden" name="types[]" value="DB_PASSWORD">
                                                        <input type="password" class="form-control" name="DB_PASSWORD"
                                                            value="{{ env('DB_PASSWORD') }}">
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

        $(document).ready(function() {
            checkMailDriver();
        });

        function checkMailDriver() {
            if ($('select[name=MAIL_DRIVER]').val() == 'mailgun') {
                $('#mailgun').show();
                $('#smtp').hide();
            } else {
                $('#mailgun').hide();
                $('#smtp').show();
            }
        }
    </script>
@endsection
