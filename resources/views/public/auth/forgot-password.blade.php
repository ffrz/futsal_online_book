@extends('public._layouts.auth')
@section('title', 'Lupa kata sandi')
@section('content')
  <div class="card-body">
    <p class="login-box-msg">Anda lupa kata sandi? Disini anda dapat dengan mudah mendapatkan kembali kata sandi anda.</p>
    <form action="{{ route('recover-password') }}" method="post">
      @csrf
      <div class="mb-3">
        <div class="input-group">
          <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}">
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
      <div class="row">
        <div class="col-12">
          <button type="submit" class="btn btn-primary btn-block">Minta kata sandi baru</button>
        </div>
      </div>
    </form>
    <p class="mt-3 mb-1">
      <a href="{{ route('login') }}">Masuk</a>
    </p>
  </div>
@endsection
