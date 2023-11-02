<aside class="main-sidebar elevation-4 sidebar-dark-lime sidebar-no-expand">
  {{-- <a class="brand-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a> --}}
  <a href="#  " class="brand-link" data-widget="pushmenu">
    <img src="{{ asset('asset/img/app-logo.png') }}" alt="" class="brand-image img-circle elevation-3"
      style="opacity: .8">
    <span class="brand-text font-weight-light">{{ env('APP_DISPLAY_NAME') }}</span>
  </a>
  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('dist/img/avatar5.png') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
      </div>
    </div>
    {{-- <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div> --}}
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar nav-legacy nav-compact flex-column nav-collapse-hide-child"
        data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="{{ route('admin.dashboard') }}" class="nav-link">
            <i class="nav-icon fas fa-chart-line"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.fields.index') }}"
            class="nav-link {{ Str::startsWith('/' . request()->route()->uri, URL::route('admin.fields.index', [], false)) ? 'active' : '' }}">
            <i class="nav-icon fas fa-vector-square"></i>
            <p>Lapangan</p>
          </a>
        </li>
        {{-- <li class="nav-item">
          <a href="{{ route('home') }}" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Transaksi
              <span class="right badge badge-danger">10</span>
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('home') }}" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Booking
              <span class="right badge badge-danger">3</span>
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Layout Options
              <i class="fas fa-angle-left right"></i>
              <span class="badge badge-info right">6</span>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="pages/layout/top-nav.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Top Navigation</p>
              </a>
            </li>
          </ul>
        </li> --}}
        <li class="nav-header">Pengguna dan Grup</li>
        <li class="nav-item">
          <a href="{{ route('admin.users.index') }}"
            class="nav-link {{ Str::startsWith('/' . request()->route()->uri, URL::route('admin.users.index', [], false)) ? 'active' : '' }}">
            <i class="nav-icon fas fa-users"></i>
            <p>Pengguna</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.user-groups.index') }}"
            class="nav-link {{ Str::startsWith('/' . request()->route()->uri, URL::route('admin.user-groups.index', [], false)) ? 'active' : '' }}">
            <i class="nav-icon fas fa-user-group"></i>
            <p>Grup Pengguna</p>
          </a>
        </li>
        <li class="nav-header">
          <hr class="nav-separator">
        </li>
        <li class="nav-item">
          <a href="{{ route('logout') }}" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>Keluar</p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
