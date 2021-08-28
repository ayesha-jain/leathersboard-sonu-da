<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | Admin | @yield('title')</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('admin_assets/AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('admin_assets/AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin_assets/AdminLTE/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_assets/AdminLTE/dist/css/admin_custom.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    @yield('customCss')
</head>
<body class="hold-transition sidebar-mini layout-fixed text-sm">
    <div class="wrapper">
        <!-- Navbar -->
        @include('admin.layouts.header')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-yellow elevation-4  ebc_theme_sidebar">
        <!-- Brand Logo -->
            <a href="{{ route('admin_dashboard') }}" class="brand-link">
                <img src="{{ asset('admin_assets/AdminLTE/dist/img/logo.png') }}" alt="Affilzone Admin" class="brand-image img-circle">
                <span class="brand-text">Admin Panel</span>
            </a>

            <!-- Sidebar -->
            @include('admin.layouts.leftSidebar')
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">@yield('title')</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            {{-- <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard v2</li>
                            </ol> --}}
                            @yield('breadcrumb')
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Content -->
            <section class="content">
                <!-- container-fluid -->
                <div class="container-fluid">
                    <!-- Main content -->
                    @yield('content')
                    <!--/. Main content -->
                </div>
                <!--/. container-fluid -->
            </section>
            <!-- /.Content -->
        </div>
        <!-- /.content-wrapper -->
        <!-- /.control-sidebar -->
        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2020 -<a href="{{ url('/') }}">European Brewery Convention</a>.</strong>
            <!-- All rights reserved. -->
            {{-- <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.0.1
            </div> --}}
        </footer>
    </div>

    <script src="{{ asset('admin_assets/AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('admin_assets/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('admin_assets/AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin_assets/AdminLTE/dist/js/adminlte.js') }}"></script>

    <!-- OPTIONAL SCRIPTS -->
    <script src="{{ asset('admin_assets/AdminLTE/dist/js/demo.js') }}"></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="{{ asset('admin_assets/AdminLTE/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
    <script src="{{ asset('admin_assets/AdminLTE/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('admin_assets/AdminLTE/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
    <script src="{{ asset('admin_assets/AdminLTE/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
<script>
//     $(document).ready(function(){
       
// $(function() {
//         $('[data-toggle="datepicker"]').datepicker({
            
//           autoHide: true,
//           zIndex: 2048,
//         });
// 		// $.ajax({
//         //     headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
//         //     type: 'GET',
//         //     url: "{{route('admin_dashboard')}}",
//         //     success: function(result) {
//         //         var data=JSON.parse(result);
//         //         console.log(data.html);
//         //         var totalNotificaion = '';
//         //         var notificationHtml= data.html;
//         //         var notificationHeader='';
//         //         totalNotificaion +='<span class="badge badge-warning navbar-badge">' + data.notification + '</span>';
//         //         notificationHeader +='<span class="dropdown-item dropdown-header" >'+ data.notification + ' Unread Notifications</span>';
//         //         $('#data_length').html(totalNotificaion);
//         //         $('#notification_header').html(notificationHeader);
//         //         $('#notification_data').html(notificationHtml);

//         //         }
//         //     });
//          });
 
//     });
    </script> 
    
    @yield('customScripts')
</body>
</html>