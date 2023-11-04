@extends('admin._layouts.main')
@section('title', $title = isset($data['id']) ? 'Edit Grup' : 'Tambah Grup')
@include('admin._components.datatable-styles')
@section('content')
  <div class="content-wrapper">
    @include('admin._components.content-header', [
        'title' => $title,
        'breadcrumbItems' => ['home', 'user-groups.index', $item->id ? 'user-groups.add' : 'user-groups.edit'],
    ])
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card with-top-border">
              <div class="card-header"></div>
              <form method="post" action="{{ route('admin.user-groups.save') }}">
                @csrf
                <input type="hidden" name="id" value="{{ $data['id'] }}">
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Nama Grup</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Nama grup"
                      value="{{ old('name', $data['name']) }}">
                    @error('name')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror()
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary mr-2"><i class="fa fa-check mr-1"></i> Simpan</button>
                  <a href="{{ route('admin.user-groups.index') }}" class="btn btn-default"><i
                      class="fa fa-xmark mr-1"></i> Batal</a>
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
