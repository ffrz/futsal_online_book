@extends('admin._layouts.main')
@section('title', $title = isset($data['id']) ? 'Edit Lapangan' : 'Tambah Lapangan')
@include('admin._components.datatable-styles')
@section('content')
  <div class="content-wrapper">
    @include('admin._components.content-header', [
        'title' => $title,
        'breadcrumbItems' => ['home', 'fields.index', empty($data['id']) ? 'fields.add' : 'fields.edit'],
    ])
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card with-border-top">
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
                    <label for="fixed_price">Harga Sewa Per Jam</label>
                    <input type="number" min="0" max="9999999" step="10000" class="form-control"
                      name="fixed_price" id="fixed_price" placeholder="Harga Dasar"
                      value="{{ old('fixed_price', isset($data['fixed_price']) ? $data['fixed_price'] : '') }}">
                    @error('fixed_price')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div>
                      <p class="text-muted font-italic">Anda bisa mengatur harga berdasarkan jam tertentu.</p>
                    </div>
                  </div>
                  <div class="form-group">
                    <table class="table">
                      <thead>
                        <tr>
                          <td></td>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $old_prices = old('prices', []); ?>
                        @for ($i = 0; $i < 23; $i++)
                          <tr>
                            <td>{{ $i }}</td>
                            <td><input type="number" name="prices[{{ $i }}]"
                                value="{{ isset($old_prices[$i]) ? $old_prices[$i] : 0 }}" class="text-right"
                                min="0" max="9999999"></td>
                          </tr>
                        @endfor
                      </tbody>
                    </table>
                  </div>
                  <div class="form-group">
                    <label for="cover">Foto</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="cover" name="cover"
                          onchange="showPreview(this, 'image-preview')">
                        <label class="custom-file-label" for="cover">Choose file</label>
                      </div>
                    </div>
                    <img class="my-3" style="width:350px;height:350px;" id="image-preview"
                      src="{{ isset($data['cover']) ? asset('storage/fields/' . $data['cover']) : asset('asset/img/no-image.png') }}"
                      alt="" width="350px">
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary mr-2"><i class="fa fa-check mr-1"></i> Simpan</button>
                  <a href="{{ route('admin.fields.index') }}" class="btn btn-default"><i class="fa fa-xmark mr-1"></i>
                    Batal</a>
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
