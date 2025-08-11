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
            <li class="breadcrumb-item"><a href="{{ route('tag') }}">Back</a></li>
            <li class="breadcrumb-item active">Edit Tag</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <form action="{{ route('tag.update', $tag->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
          <div class="col-md-8">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form Edit Tag Artikel</h3>
              </div>

              <div class="card-body">
                <div class="form-group">
                  <label for="nama_tag">Nama Tag</label>
                  <input type="text" name="nama_tag" class="form-control" 
                         value="{{ old('nama_tag', $tag->nama_tag) }}" 
                         placeholder="Contoh: Berita, Tutorial, Hiburan">
                  @error('nama_tag')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-success">Update Tag</button>
                <a href="{{ route('tag') }}" class="btn btn-secondary">Batal</a>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </section>
</div>

@endsection
