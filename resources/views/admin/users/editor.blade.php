@extends('admin._layouts.main')
@section('title', $title = isset($data['id']) ? 'Edit Pengguna' : 'Tambah Pengguna')
@include('admin._components.datatable-styles')
@section('content')
  <div class="content-wrapper">
    @include('admin._components.content-header', [
        'title' => $title,
        'breadcrumbItems' => ['home', 'users.index', empty($data['id']) ? 'users.add' : 'users.edit'],
    ])
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card with-border-top">
              <form method="post" action="{{ route('admin.users.save') }}">
                @csrf
                <input type="hidden" id="{{ isset($data['id']) ? $data['id'] : '' }}">
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control" id="name" name="name"
                      value="{{ old('name', empty($data->name) ? '' : $data->name) }}" placeholder="Masukkan nama">
                    @error('name')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="email">Alamat Email</label>
                    <input type="email" class="form-control" id="email" name="email"
                      value="{{ old('email', empty($data->email) ? '' : $data->email) }}"
                      placeholder="Masukkan alamat email">
                    @error('email')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="group">Grup Pengguna</label>
                    <select name="group_id" id="group" class="form-control">
                      @foreach ($userGroups as $group)
                        <option value="{{ $group->id }}"
                          {{ $group->id == old('group_id', isset($data['group_id']) ? $data['group_id'] : 0) ? 'selected' : '' }}>
                          {{ $group->name }}</option>
                      @endforeach
                    </select>
                    @error('group_id')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="password">Kata Sandi</label>
                    <input type="password" class="form-control" id="password" name="password" value=""
                      placeholder="Kata sandi">
                    @error('password')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary mr-2"><i class="fa fa-check mr-1"></i> Simpan</button>
                  <button type="reset" class="btn btn-warning" onclick="return confirm('Anda yakin?')">
                    <i class="fa fa-xmark mr-1"></i> Reset
                  </button>
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
