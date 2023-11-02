@extends('admin._layouts.main')
@section('title', 'Pengguna')
@include('admin._components.datatable-styles')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pengguna</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Pengguna</li>
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
                <a href="{{ route('admin.users.add') }}" class="btn btn-primary">Tambah</a>
              </div>
              <div class="card-body">
                <div id="example1_wrapper" class="">
                  <table id="example" class="display compact table table-bordered table-striped table-hover" style="width:100%">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Grup</th>
                        <th>Email</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody><tr><td colspan="5" class="text-center">Retriving data...</td></tr></tbody>
                    <tfoot>
                      <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Grup</th>
                        <th>Email</th>
                        <th>Aksi</th>
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
      ajax: '{{ url('admin/ajax/users') }}',
      search: { return: true },
      processing: true,
      serverSide: true,
      scrollX: true,
      language: {
        url: '{{ asset('plugins/datatables-i18n/id.json') }}',
      },
      columns: [{
          data: 'id',
          visible: false,
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
        {
          data: 'id',
          render: function() {
            return '<a class="btn btn-sm btn-danger" title="Ban User" href="#"><i class="fa fa-hand"></i></a>';
          }
        }
      ]
    });
  </script>
@endsection
