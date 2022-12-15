<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Laravel</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="{{ asset('/') }}plugins/fonts/source_sans_pro.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('/') }}plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('/') }}plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('/') }}css/adminlte.min.css">
  {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> --}}
{{-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> --}}
{{-- <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet"> --}}

<script src="{{ asset('/') }}plugins/jquery/jquery.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="{{ asset('/') }}plugins/bootstrap/css/bootstrap.min.css">

<link href="{{ asset('/') }}plugins/jquery/jquery.dataTables.min.css" rel="stylesheet">

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script> --}}
<link rel="stylesheet" href="{{ asset('/') }}plugins/summernote/summernote.min.css" />
<script src="{{ asset('/') }}plugins/select2/js/select2.min.js"></script>
<link rel="stylesheet" href="{{ asset('/') }}plugins/select2/css/select2.min.css">
<script src="{{ asset('/') }}plugins/sweetalert2/sweetalert2.min.js"></script>
<link rel="stylesheet" href="{{ asset('/') }}plugins/sweetalert2/sweetalert2.min.css" id="theme-styles">
<!-- icheck bootstrap -->
<link rel="stylesheet" href="{{ asset('/') }}plugins/icheck-bootstrap/icheck-bootstrap.min.css">
</head>
<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed layout-footer-fixed">
<!-- Site wrapper -->
<div class="wrapper">

    @include('layouts.header')

  <!-- Main Sidebar Container -->
    @include('layouts.sidebar')

  <!-- Content Wrapper. Contains page content -->
  {{-- <div class="content-wrapper"> --}}
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    @yield('content')
    {{-- <section class="content">

      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Default box -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Title</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                Start creating your amazing application!
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                Footer
              </div>
              <!-- /.card-footer-->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section> --}}
    <!-- /.content -->
  {{-- </div> --}}
  <!-- /.content-wrapper -->
    @include('layouts.footer')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('/') }}plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
{{-- <script>
$.widget.bridge('uibutton', $.ui.button)
</script> --}}
<!-- Bootstrap 4 -->
<script src="{{ asset('/') }}plugins/summernote/summernote-bs5.min.js"></script>

<script src="{{ asset('/') }}plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('/') }}plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/') }}js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('/') }}plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('/') }}plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('/') }}plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('/') }}plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- comment -->
{{-- <script src="{{ asset('/') }}plugins/jquery-validation/jquery.validate.js"></script> --}}
<script src="{{ asset('/') }}plugins/jquery-validation/jquery.validate.min.js" type="text/javascript"></script>
<script src="{{ asset('/') }}plugins/jquery/additional-methods.min.js"></script>
<script src="{{ asset('/') }}plugins/sweetalert2/sweetalert2.all.min.js"></script>

@stack('scripts')
</body>
</html>
