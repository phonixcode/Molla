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
                        <p>
                            System Information
                        </p>
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
                        <table class="table table-sm mg-b-0">
                            <tbody>
                                <tr>
                                    <td class="font-weight-bold" width="25%">PHP Version</td>
                                    <td class="tx-color-03" width="75%">{{ $currentPHP }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold" width="25%">Laravel Version</td>
                                    <td class="tx-color-03" width="75%">{{ $laravelVersion }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold" width="25%">Server Software</td>
                                    <td class="tx-color-03" width="75%">{{ $serverDetails['SERVER_SOFTWARE'] }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold" width="25%">Server IP Address</td>
                                    <td class="tx-color-03" width="75%">{{ $serverDetails['SERVER_ADDR'] }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold" width="25%">Server Protocol</td>
                                    <td class="tx-color-03" width="75%">{{ $serverDetails['SERVER_PROTOCOL'] }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold" width="25%">HTTP Host</td>
                                    <td class="tx-color-03" width="75%">{{ $serverDetails['HTTP_HOST'] }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold" width="25%">Database Port</td>
                                    <td class="tx-color-03" width="75%">{{ @$serverDetails['DB_PORT'] }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold" width="25%">App Environment</td>
                                    <td class="tx-color-03" width="75%">{{ $serverDetails['APP_ENV'] }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold" width="25%">App Debug</td>
                                    <td class="tx-color-03" width="75%">{{ $serverDetails['APP_DEBUG'] }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold" width="25%">Timezone</td>
                                    <td class="tx-color-03" width="75%">{{ $timeZone }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end container-fluid -->
</div>
@endsection
