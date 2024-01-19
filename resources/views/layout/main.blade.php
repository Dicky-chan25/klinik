<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @yield('title')
 
    <!-- icon Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('') }}assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('') }}assets/dist/css/adminlte.min.css">
   <!-- Ionicons -->
   <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
   <!-- Tempusdominus Bootstrap 4 -->
   <link rel="stylesheet" href="{{ asset('') }}assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
   <!-- iCheck -->
   <link rel="stylesheet" href="{{ asset('') }}assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
   <!-- JQVMap -->
   <link rel="stylesheet" href="{{ asset('') }}assets/plugins/jqvmap/jqvmap.min.css">
   <!-- overlayScrollbars -->
   <link rel="stylesheet" href="{{ asset('') }}assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
   <!-- Daterange picker -->
   <link rel="stylesheet" href="{{ asset('') }}assets/plugins/daterangepicker/daterangepicker.css">
   <!-- summernote -->
   <link rel="stylesheet" href="{{ asset('') }}assets/plugins/summernote/summernote-bs4.min.css">
     <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('') }}assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('') }}assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('') }}assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('') }}assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

   <link rel="icon" href="{{ asset('') }}assets/img/icon.png" />
   {{-- <link href="{{ asset('') }}assets/css/styles-index.css" rel="stylesheet" /> --}}
  </head>
  <body class="hold-transition sidebar-mini layout-fixed layout-footer-fixed layout-navbar-fixed" onload="initClock()">
  <div class="wrapper">

      <!-- Preloader -->
  {{-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ asset('') }}assets/dist/img/klinik.png" alt="AdminLTELogo" height="60" width="60">
  </div> --}}

      @include('layout.header')

      @include('layout.sidebar')

        <div class="content-wrapper">
                @yield('container')
        </div>
      {{-- @include('layout.footer') --}}
  
  </div>

<!-- jQuery -->
<script src="{{ asset('') }}assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('') }}assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('') }}assets/dist/js/adminlte.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('') }}assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{ asset('') }}assets/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="{{ asset('') }}assets/plugins/raphael/raphael.min.js"></script>
<script src="{{ asset('') }}assets/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="{{ asset('') }}assets/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="{{ asset('') }}assets/plugins/chart.js/Chart.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('') }}assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('') }}assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('') }}assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('') }}assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ asset('') }}assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('') }}assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{ asset('') }}assets/plugins/jszip/jszip.min.js"></script>
<script src="{{ asset('') }}assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{ asset('') }}assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{ asset('') }}assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{ asset('') }}assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{ asset('') }}assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Select2 -->
<script src="{{ asset('') }}assets/plugins/select2/js/select2.full.min.js"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('') }}assets/dist/js/pages/dashboard2.js"></script>

{{-- <script src="{{ asset('') }}assets/dist/js/demo.js"></script> --}}

@stack('datatable-scripts')
@stack('select2-scripts')

</body>
</html>
