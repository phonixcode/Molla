<meta charset="UTF-8">
<meta name="description" content="{{ get_setting('meta_description') }}">
<meta name="keywords" content="{{ get_setting('meta_keywords') }}">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

<!-- Title  -->
<title>{{ get_setting('title') }}</title>

<!-- Favicon  -->
<link rel="icon" href="{{ get_setting('favicon') }}">

<!-- Style CSS -->
<link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
{{-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui-css"> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

@yield('style')
