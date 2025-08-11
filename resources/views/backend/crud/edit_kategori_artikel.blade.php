@extends('backend.layout.main')
@section('content')

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Kategori Artikel</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('kategori') }}">Back</a></li>
            <li class="breadcrumb-item active">Edit Kategori</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
          <div class="col-md-8">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form Edit Kategori Artikel</h3>
              </div>

              <div class="card-body">
                <div class="form-group">
                  <label for="nama_kategori">Nama Kategori</label>
                  <input type="text" name="nama_kategori" class="form-control" 
                         value="{{ old('nama_kategori', $kategori->nama_kategori) }}" 
                         placeholder="Contoh: Politik, Teknologi, Budaya">
                  @error('nama_kategori')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="deskripsi">Deskripsi (Opsional)</label>
                  <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
                  @error('deskripsi')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-success">Update Kategori</button>
                <a href="{{ route('kategori') }}" class="btn btn-secondary">Batal</a>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </section>
</div>

@endsection
