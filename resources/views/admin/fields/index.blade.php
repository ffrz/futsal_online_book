<?php $title = 'Daftar Lapangan'; ?>
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
            <div class="card">
              <div class="card-header">
                <a href="{{ route('admin.fields.add') }}" class="btn btn-primary">Tambah</a>
              </div>
              <div class="card-body">
                <div id="example1_wrapper" class="">
                  <table id="example" class="display table table-bordered table-striped table-hover" style="width:100%">
                    <thead>
                      <tr>
                        <th>Nama Lapangan</th>
                        <th>Cover</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($fields as $item)
                        <tr>
                          <td><a href="{{ route('admin.fields.edit', $item->id) }}">{{ $item->name }}</a></td>
                          <td><img src="{{ asset('storage/fields/' . $item->cover) }}" alt="" width="150px"></td>
                        </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Nama Grup</th>
                        <th>Jumlah Pengguna</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
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
      scrollX: true,
      language: {
        url: '{{ asset('plugins/datatables-i18n/id.json') }}',
      },
    });
  </script>
@endsection
