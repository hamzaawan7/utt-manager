<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>@section('title')
            {{'Login'}}
        @endsection</title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('admin-dashboard-layout/images/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('admin-dashboard-layout/images/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('admin-dashboard-layout/images/favicon-16x16.png')}}">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
          rel="stylesheetssss">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('admin-dashboard-layout/styles/core.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin-dashboard-layout/styles/icon-font.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin-dashboard-layout/styles/style.css')}}">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-119386393-1');
    </script>
</head>
<body class="login-page">

@yield('content')


<!-- js -->
<script src="{{asset('admin-dashboard-layout/scripts/core.js')}}"></script>
<script src="{{asset('admin-dashboard-layout/scripts/script.min.js')}}"></script>
<script src="{{asset('admin-dashboard-layout/scripts/process.js')}}"></script>
<script src="{{asset('admin-dashboard-layout/scripts/layout-settings.js')}}"></script>
</body>
</html>