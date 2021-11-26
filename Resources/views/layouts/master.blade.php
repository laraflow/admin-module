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
<body class="hold-transition layout-fixed @yield('body-class')">
<div class="wrapper">
    <!-- Preloader -->
@include('admin::layouts.includes.preloader')
<!-- Navbar -->
@include('admin::layouts.partials.navbar')

<!-- Main Sidebar Container -->
@include('admin::layouts.partials.menu-sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('admin::layouts.partials.content-header')
    <!-- Main content -->
        <section class="content">
            @include('admin::layouts.includes.errors')

            @yield('content')

            @include('admin::layouts.partials.confirm-modal')

            @include('admin::layouts.partials.export-modal')
            @include('admin::layouts.partials.import-modal')
        </section>
        <!-- /.content -->
        <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
            <i class="fas fa-chevron-up"></i>
        </a>
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
@include('admin::layouts.partials.control-sidebar')
<!-- Main Footer -->
    @include('admin::layouts.partials.main-footer')
</div>
<!-- ./wrapper -->
<!-- JS Constants -->
@include('admin::layouts.includes.js-constants')
<!-- jQuery -->
<script src="{{ asset('modules/admin/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('modules/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Plugin JS -->
@include('admin::layouts.includes.plugin-script')
<!-- AdminLTE App -->
<script src="{{ asset('modules/admin/assets/js/adminlte.min.js') }}"></script>
<script src="{{ asset('modules/admin/assets/js/utility.min.js') }}"></script>
<!-- inline js -->
@include('admin::layouts.includes.page-script')
</body>
</html>
