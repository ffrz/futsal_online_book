@extends('public._layouts.auth')
@section('title', 'Registrasi')
@section('content')
  <div class="card-body">
    <h4>Registrasi Selesai</h4>
    <p>Selamat, anda telah terdaftar pada sistem kami. Silahkan periksa email anda <b>{{ $email }}</b>
    untuk memverifikasi akun anda. Atau anda dapat masuk di halaman <a href="{{ route('login') }}">login</a>.</p>
  </div>
@endsection
