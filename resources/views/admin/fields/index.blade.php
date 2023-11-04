@extends('admin._layouts.main')
@section('title', $title = 'Lapangan')
@include('admin._components.datatable-styles')
@section('content')
  <div class="content-wrapper">
    @include('admin._components.content-header', [
        'title' => $title,
        'breadcrumbItems' => ['home', 'fields.index'],
    ])
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card with-border-top">
              <div class="card-header">
                <a href="{{ route('admin.fields.add') }}" class="btn btn-primary">Tambah</a>
              </div>
              <div class="card-body">
                <div id="example1_wrapper" class="">
                  <table id="example" class="display table table-bordered table-striped table-hover" style="width:100%">
                    <thead>
                      <tr>
                        <th>Lapangan</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($fields as $item)
                        <tr>
                          <td>
                            <div><a href="{{ route('admin.fields.edit', $item->id) }}">{{ $item->name }}</a></div>
                            <div><img src="{{ asset('storage/fields/' . $item->cover) }}" alt="" width="150px">
                            </div>
                          </td>
                          <td>
                            Tarif Dasar: @formatNumber($item->fixed_price)
                            <br>
                            Tarif berdasarkan jam:
                            <ul>
                              @foreach ($item->prices as $item)
                                <li>{{ str_pad($item->hour, 2, '0', STR_PAD_LEFT) }} = @formatNumber($item->price)</li>
                              @endforeach
                            </ul>
                          </td>
                          <td>
                            <form method="post" action="{{ route('admin.fields.delete') }}"
                              onsubmit="return confirmDelete(this);">
                              @csrf
                              <input type="hidden" name="id" value="{{ $item->id }}">
                              <button class="btn btn-danger" type="submit"><i class="fa fa-trash mr-2"></i>Hapus</button>
                            </form>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Lapangan</th>
                        <th>Harga</th>
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
      scrollX: true,
      language: {
        url: '{{ asset('plugins/datatables-i18n/id.json') }}',
      },
    });
  </script>
@endsection
