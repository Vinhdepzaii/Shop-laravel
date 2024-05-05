<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">


<!-- Mirrored from tixia.dexignzone.com/xhtml/page-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 23 Jun 2023 09:01:11 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="admin, dashboard" />
    <meta name="author" content="DexignZone" />
    <meta name="robots" content="index, follow" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="tixia : tixia School Admission Admin  Bootstrap 5 Template" />
    <meta property="og:title" content="tixia : tixia School Admission Admin  Bootstrap 5 Template" />
    <meta property="og:description" content="tixia : tixia School Admission Admin  Bootstrap 5 Template" />
    <meta property="og:image" content="social-image.png" />
    <meta name="format-detection" content="telephone=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Adara </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('templates/fe/img/favicon.png') }}">
    <link href="{{ asset('templates/be/css/style.css') }}" rel="stylesheet">

</head>
<body class="vh-100">
<div class="authincation h-100">
    @yield('content')
</div>


<!--**********************************
    Scripts
***********************************-->
<!-- Required vendors -->
<script src="{{ asset('templates/be/vendor/global/global.min.js') }}"></script>
<script src="{{ asset('templates/be/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('templates/be/js/custom.min.js') }}"></script>
<script src="{{ asset('templates/be/js/deznav-init.js') }}"></script>

</body>


<!-- Mirrored from tixia.dexignzone.com/xhtml/page-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 23 Jun 2023 09:01:12 GMT -->
</html>
