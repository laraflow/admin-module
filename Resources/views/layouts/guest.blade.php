<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>
    <!-- meta Tags -->
@include('admin::layouts.includes.meta')
<!-- Web Font-->
@include('admin::layouts.includes.webfont')
<!-- Icon -->
@include('admin::layouts.includes.icon')
<!-- Plugins -->
@include('admin::layouts.includes.plugin-style')
<!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('modules/admin/assets/css/adminlte.min.css') }}">
    <!-- Page Level Style -->
@include('admin::layouts.includes.inline-style')
<!-- Page Level Script -->
    @include('admin::layouts.includes.head-script')
</head>
<body class="hold-transition @yield('body-class')">
@yield('content')
@include('admin::partials.footer')
<!-- jQuery -->
<script src="{{ asset('modules/admin/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('modules/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Plugin JS -->
@include('admin::layouts.includes.plugin-script')
<!-- AdminLTE App -->
<script src="{{ asset('modules/admin/assets/js/adminlte.min.js') }}"></script>
<!-- inline js -->
@include('admin::layouts.includes.page-script')
</body>
</html>
