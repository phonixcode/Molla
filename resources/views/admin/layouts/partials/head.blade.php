<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<meta name="description" content="{{ get_setting('meta_description') }}" />
<meta name="author" content="Frocode Tech Solutions" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<title>{{ get_setting('title') }}</title>
<!-- app favicon -->
<link rel="shortcut icon" href="{{ get_setting('favicon') }}">
<!-- google fonts -->
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
<!-- plugin stylesheets -->
<link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/vendors.css') }}" />
<!-- app style -->
<link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/style.css') }}" />
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
@yield('style')
