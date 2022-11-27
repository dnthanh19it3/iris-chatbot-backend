<!DOCTYPE html>
<html lang="en">
@include("admin.components.head")
<body class="hold-transition sidebar-mini layout-navbar-fixed">
<!-- Site wrapper -->
<div class="wrapper">
    <!-- Navbar -->
    @include("admin.components.navbar")
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include("admin.components.sidebar")
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>@yield("title")</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Layout</a></li>
                            <li class="breadcrumb-item active">Fixed Navbar Layout</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @yield("body")
{{--                <div class="row">--}}
{{--                    <div class="col-12">--}}
{{--                        <!-- Default box -->--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-header">--}}
{{--                                <h3 class="card-title">Title</h3>--}}
{{--                                <div class="card-tools">--}}
{{--                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">--}}
{{--                                        <i class="fas fa-minus"></i>--}}
{{--                                    </button>--}}
{{--                                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">--}}
{{--                                        <i class="fas fa-times"></i>--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="card-body">--}}
{{--                                Start creating your amazing application!--}}
{{--                            </div>--}}
{{--                            <!-- /.card-body -->--}}
{{--                            <div class="card-footer">--}}
{{--                                Footer--}}
{{--                            </div>--}}
{{--                            <!-- /.card-footer-->--}}
{{--                        </div>--}}
{{--                        <!-- /.card -->--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 3.2.0
        </div>
        <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
@include("admin.components.foot_script")
</body>
</html>
