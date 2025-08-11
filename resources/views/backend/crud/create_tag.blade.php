@extends('backend.layout.main')
@section('content')

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Tag Artikel</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Tambah Tag</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <form action="{{ route('tag.store') }}" method="POST">
        @csrf
        <div class="row">
          <div class="col-md-8">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form Tambah Tag Artikel</h3>
              </div>

              <div class="card-body">
                <div class="form-group">
                  <label for="nama_tag">Nama Tag</label>
                  <input type="text" name="nama_tag" class="form-control" value="{{ old('nama_tag') }}" placeholder="Contoh: Politik, AI, Teknologi">
                  @error('nama_tag')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="slug">Slug (Opsional)</label>
                  <input type="text" name="slug" class="form-control" value="{{ old('slug') }}" placeholder="Biarkan kosong untuk generate otomatis">
                  @error('slug')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan Tag</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </section>
</div>

@endsection
