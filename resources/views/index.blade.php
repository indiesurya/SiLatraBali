<!DOCTYPE html>
<html lang="en">
@include("template.header")

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->

        @include("template.navigation")
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include("template.sidebar")

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            @yield('contents')
            <!-- /.content -->

            <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
                <i class="fas fa-chevron-up"></i>
            </a>
        </div>
        <!-- /.content-wrapper -->

        @include("template.footer")
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    @include("template.js")
</body>

</html>