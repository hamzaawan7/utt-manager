<!DOCTYPE html>
<html>
<head>

    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title> @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('admin-dashboard-layout/images/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('admin-dashboard-layout/images/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('admin-dashboard-layout/images/favicon-16x16.png')}}">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('admin-dashboard-layout/styles/core.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin-dashboard-layout/styles/icon-font.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatables/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatables/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin-dashboard-layout/styles/style.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-119386393-1');
    </script>
</head>
<body>

@include('layouts.preloader')
@include('layouts.header')
@include('layouts.right_sidebar')
@include('layouts.sidebar')


<div class="mobile-menu-overlay"></div>

<div class="main-container">

    @yield('content')

</div>
<!-- js -->
<script src="{{asset('admin-dashboard-layout/scripts/core.js')}}"></script>
<script src="{{asset('admin-dashboard-layout/scripts/script.min.js')}}"></script>
<script src="{{asset('admin-dashboard-layout/scripts/process.js')}}"></script>
<script src="{{asset('admin-dashboard-layout/scripts/layout-settings.js')}}"></script>
<script src="{{asset('src/plugins/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('src/plugins/datatables/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('src/plugins/datatables/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('src/plugins/datatables/js/responsive.bootstrap4.min.js')}}"></script>

<!-- buttons for Export datatable -->
<script src="{{asset('src/plugins/datatables/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('src/plugins/datatables/js/buttons.print.min.js')}}"></script>
<script src="{{asset('src/plugins/datatables/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('src/plugins/datatables/js/buttons.flash.min.js')}}"></script>
<script src="{{asset('src/plugins/datatables/js/pdfmake.min.js')}}"></script>
<script src="{{asset('src/plugins/datatables/js/vfs_fonts.js')}}"></script>
<!-- Datatable Setting js -->
<script src="{{asset('admin-dashboard-layout/scripts/datatable-setting.js')}}"></script>
<script src="{{asset('src/plugins/jquery-steps/jquery.steps.js')}}"></script>
<script src="{{asset('admin-dashboard-layout/scripts/steps-setting.js')}}"></script>
<script src="{{asset('admin-dashboard-layout/scripts/layout-settings.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('src/js/script.js')}}"></script>

</body>
</html>
