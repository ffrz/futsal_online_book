<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ env('APP_DISPLAY_NAME') }} | @yield('title')</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  @yield('headstyles')
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
  <link rel="stylesheet" href="{{ mix('/resources/css/admin.css') }}">
  @vite([])
</head>

<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed layout-footer-fixed dropdown-legacy">
  <div class="wrapper">
    @include('admin._components.navbar')
    @include('admin._components.sidebar')
    @yield('content')
    <footer class="main-footer">
      <strong>&copy; 2023 <a href="https://shiftech.com">Shift IT Solution</a>.</strong>
      <div class="float-right d-none d-sm-inline-block">
        FutsalRentApp V 1.0.0
      </div>
    </footer>
  </div>
  <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
  <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
  @yield('footscripts')
  <script src="{{ asset('dist/js/adminlte.js') }}"></script>
  <script src="{{ mix('/resources/js/admin.js') }}"></script>
  <script>
    @if ($msg = session('flash-message'))
      toastr.options = {
        "closeButton": true,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
      }
      $(document).ready(function onDocumentReady() {
        toastr['{{ $msg[0] }}']('{{ $msg[1] }}', '{{ isset($msg[2]) ? $msg[2] : '' }}');
      });
    @endif
  </script>
  @yield('footscript')
</body>

</html>
