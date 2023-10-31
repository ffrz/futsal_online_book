@extends('public._layouts.auth')
@section('title', 'Masuk')
@section('content')
  <div class="card-body">
    <p class="login-box-msg">Masuk untuk memulai sesi anda</p>
    @if (session('message'))
      <div class="alert alert-warning alert-dismissible" role="alert">
        {{ session('message') }}
      </div>
    @endif
    <form action="{{ route('process-login') }}" method="post">
      @csrf
      <div class="my-3">
        <div class="input-group">
          <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}"
            required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        @error('email')
          <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="my-3">
        <div class="input-group">
          <input type="password" class="form-control" placeholder="Kata sandi" name="password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        @error('password')
          <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="row">
        <div class="col-8">
          <div class="icheck-primary">
            <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
            <label for="remember">
              Ingat saya
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-4">
          <button type="submit" class="btn btn-primary btn-block">Masuk</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <div class="social-auth-links text-center mt-2 mb-3">
      <a href="#" class="btn btn-block btn-primary">
        <i class="fab fa-facebook mr-2"></i> Masuk menggunakan Facebook
      </a>
      <a href="#" class="btn btn-block btn-danger">
        <i class="fab fa-google-plus mr-2"></i> Masuk menggunakan Google+
      </a>
    </div>
    <!-- /.social-auth-links -->

    <p class="mb-1">
      <a href="{{ route('forgot-password') }}">Saya lupa kata sandi</a>
    </p>
    <p class="mb-0">
      <a href="{{ route('register') }}" class="text-center">Buat akun baru</a>
    </p>
  </div>
  <!-- /.card-body -->
@endsection
