<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fishiden</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ \App\Helper\Utility::loadAsset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ \App\Helper\Utility::loadAsset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ \App\Helper\Utility::loadAsset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ \App\Helper\Utility::loadAsset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ \App\Helper\Utility::loadAsset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    @yield('css')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
                <span class="brand-text font-weight-light">Fishiden</span>
            </a>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="{{route('dashboard.index')}}" class="nav-link {{ \App\Helper\Utility::stateMenu(['dashboard'],request())? 'active':'' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('katalog_ikan.index')}}" class="nav-link {{ \App\Helper\Utility::stateMenu(['katalog_ikan'],request())? 'active':'' }}">
                            <i class="nav-icon far fa-image"></i>
                            <p>
                                Katalog Ikan
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->

            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->
    </div>
    <!-- ./wrapper -->
</body>
<!-- jQuery -->
<script src="{{ \App\Helper\Utility::loadAsset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ \App\Helper\Utility::loadAsset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ \App\Helper\Utility::loadAsset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ \App\Helper\Utility::loadAsset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ \App\Helper\Utility::loadAsset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ \App\Helper\Utility::loadAsset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ \App\Helper\Utility::loadAsset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ \App\Helper\Utility::loadAsset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ \App\Helper\Utility::loadAsset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ \App\Helper\Utility::loadAsset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ \App\Helper\Utility::loadAsset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ \App\Helper\Utility::loadAsset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ \App\Helper\Utility::loadAsset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ \App\Helper\Utility::loadAsset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<script src="{{ \App\Helper\Utility::loadAsset('dist/js/adminlte.min.js?v=3.2.0') }}"></script>

<script src="{{ \App\Helper\Utility::loadAsset('dist/js/demo.js') }}"></script>
<script>
    $(function() {
        // bsCustomFileInput.init();
    });
</script>
@yield('script')

</html>