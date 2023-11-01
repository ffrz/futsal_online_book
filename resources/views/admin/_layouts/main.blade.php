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
  @vite(['resources/css/admin.css'])
</head>

<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed layout-footer-fixed dropdown-legacy">
  <div class="wrapper">
    @include('admin._components.navbar')
    @include('admin._components.sidebar')
    @yield('content')
    <footer class="main-footer">
      <strong>&copy; 2023 <a href="https://shiftech.com">Shift IT Solution</a>.</strong>
      <div class="float-right d-none d-sm-inline-block">
        FutsalRentApp <b>V</b> 1.0.0
      </div>
    </footer>
  </div>
  <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  @yield('footscripts')
  <script src="{{ asset('dist/js/adminlte.js') }}"></script>
  @yield('footscript')
</body>

</html>
