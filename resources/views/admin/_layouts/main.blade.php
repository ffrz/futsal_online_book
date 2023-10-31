<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ env('APP_DISPLAY_NAME') }} | @yield('title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  @yield('headstyles')
  @vite('resources/css/admin.css')
</head>
<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed layout-footer-fixed dropdown-legacy">
  <div class="wrapper">
    @include('admin._components.navbar')
    @include('admin._components.sidebar')
    @yield('content')
    <footer class="main-footer">
      <strong>Copyright &copy; 2023 <a href="https://shiftech.com">Shift IT Solution</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        FutsalRentApp <b>Version</b> 1.0.0
      </div>
    </footer>
  </div>
  <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('dist/js/adminlte.js') }}"></script>
  <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
  @vite('resources/js/admin.js')
</body>

</html>
