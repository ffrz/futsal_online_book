<?php $title = isset($data['id']) ? 'Edit Lapangan' : 'Tambah Lapangan'; ?>
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
              <li class="breadcrumb-item"><a href="{{ route('admin.fields.index') }}">Lapangan</a></li>
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
              <form method="post" action="{{ route('admin.fields.save') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ isset($data['id']) ? $data['id'] : 0 }}">
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Nama Lapangan</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Nama Lapangan"
                      value="{{ old('name', isset($data['name']) ? $data['name'] : '') }}">
                    @error('name')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror()
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="cover" name="cover"
                          onchange="showPreview(this, 'image-preview')">
                        <label class="custom-file-label" for="cover">Choose file</label>
                      </div>
                    </div>
                    <img class="my-3" style="border:2px solid #888;width:350px;height:350px;" id="image-preview"
                      src="{{ isset($data['cover']) ? asset('storage/fields/' . $data['cover']) : '' }}" alt=""
                      width="350px">
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

    function showPreview(input, elementId) {
      for (var i = 0; i < input.files.length; i++) {
        var file = input.files[i];
        var type = /image.*/;
        var preview = document.getElementById(elementId);
        var reader = new FileReader();
        if (file.type.match(type)) {
          preview.file = file;
          reader.onload = (function(element) {
            return function(e) {
              element.src = e.target.result;
            };
          })(preview);
          reader.readAsDataURL(file);
        } else {
          alert("Tipe file tidak sesuai. Gambar harus bertipe .png, .gif atau .jpg.");
        }
      }
    }
  </script>
@endsection
