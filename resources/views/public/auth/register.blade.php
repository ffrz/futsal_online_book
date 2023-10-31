@extends('public._layouts.auth')
@section('title', 'Registrasi')
@section('content')
  <div class="card-body">
    <p class="login-box-msg">Buat akun baru</p>

    <form action="{{ route('process-registration') }}" method="post">
      @csrf
      <div class="mb-3">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Nama Lengkap" name="name" value="{{ old('name') }}"
            required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        @error('name')
          <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>
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
      <div class="my-3">
        <div class="input-group">
          <input type="password" class="form-control" placeholder="Ulangi kata sandi" name="password_confirmation"
            required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        @error('password_confirmation')
          <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="row">
        <div class="col-8">
          <div class="icheck-primary">
            <input type="checkbox" id="agreeTerms" name="terms" value="agree" required checked>
            <label for="agreeTerms">
              Saya setuju dengan <a href="#">terms</a>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-4">
          <button type="submit" class="btn btn-primary btn-block">Daftar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <div class="social-auth-links text-center">
      <a href="#" class="btn btn-block btn-primary">
        <i class="fab fa-facebook mr-2"></i>
        Daftar menggunakan Facebook
      </a>
      <a href="#" class="btn btn-block btn-danger">
        <i class="fab fa-google-plus mr-2"></i>
        Daftar menggunakan Google+
      </a>
    </div>

    <a href="{{ route('login') }}" class="text-center">Saya sudah punya akun</a>
  </div>
  <!-- /.form-box -->
@endsection
