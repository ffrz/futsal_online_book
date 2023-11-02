<?php $title = isset($data['id']) ? 'Edit Grup' : 'Tambah Grup'; ?>
@extends('admin._layouts.main')
@section('title', $title)
@include('admin._components.datatable-styles')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ $title }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('admin.user-groups.index') }}">Grup Pengguna</a></li>
              <li class="breadcrumb-item active">{{ $title }}</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header"></div>
              <form method="post" action="{{ route('admin.user-groups.save') }}">
                @csrf
                <input type="hidden" name="id" value="{{ $data['id'] }}">
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Nama Grup</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Nama grup" value="{{ old('name', $data['name'] )}}">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror()
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i> Simpan</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
@include('admin._components.datatable-scripts')
@section('footscript')
  <script>
    new DataTable('#example', {
      ajax: '{{ url('admin/ajax/users') }}',
      processing: true,
      serverSide: true,
      scrollX: true,
      columns: [{
          data: 'id'
        },
        {
          data: 'name'
        },
        {
          data: 'group'
        },
        {
          data: 'email'
        },
      ]
    });
  </script>
@endsection
