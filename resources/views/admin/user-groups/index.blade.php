@extends('admin._layouts.main')
@section('title', $title = 'Grup Pengguna')
@include('admin._components.datatable-styles')
@section('content')
  <div class="content-wrapper">
    @include('admin._components.content-header', [
        'title' => $title,
        'breadcrumbItems' => ['home', 'user-groups.index'],
    ])
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card with-border-top">
              <div class="card-body">
                <div id="example1_wrapper" class="">
                  <table id="example" class="display table table-bordered table-striped table-hover" style="width:100%">
                    <thead>
                      <tr>
                        <th>Nama Grup</th>
                        <th>Jumlah Pengguna</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($items as $item)
                        <tr>
                          <td><a href="{{ route('admin.user-groups.edit', $item->id) }}">{{ $item->name }}</a></td>
                          <td>{{ $item->userCount }}</td>
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
