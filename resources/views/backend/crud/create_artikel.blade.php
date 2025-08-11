@extends('backend.layout.main')
@section('content')

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Tambah Artikel</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('artikels') }}">Back</a></li>
            <li class="breadcrumb-item active">Tambah Artikel</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <form action="{{ route('artikel.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-md-8">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form Tambah Artikel</h3>
              </div>

              <div class="card-body">

                {{-- Judul --}}
                <div class="form-group">
                  <label for="judul">Judul Artikel</label>
                  <input type="text" name="judul" class="form-control" value="{{ old('judul') }}">
                  @error('judul')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                {{-- Slug --}}
                <div class="form-group">
                  <label for="slug">Slug</label>
                  <input type="text" name="slug" class="form-control" value="{{ old('slug') }}">
                  @error('slug')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                {{-- Kategori --}}
                <div class="form-group">
                  <label for="kategori_id">Kategori</label>
                  <select name="kategori_id" class="form-control">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($kategori as $kat)
                      <option value="{{ $kat->id }}" {{ old('kategori_id') == $kat->id ? 'selected' : '' }}>
                        {{ $kat->nama_kategori }}
                      </option>
                    @endforeach
                  </select>
                  @error('kategori_id')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                {{-- Excerpt --}}
                <div class="form-group">
                  <label for="excerpt">Excerpt (Opsional)</label>
                  <textarea name="excerpt" class="form-control" rows="3">{{ old('excerpt') }}</textarea>
                  @error('excerpt')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                {{-- Isi --}}
                <div class="form-group">
                  <label for="isi">Isi Artikel</label>
                  <textarea name="isi" class="form-control" rows="8">{{ old('isi') }}</textarea>
                  @error('isi')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                {{-- Thumbnail --}}
                <div class="form-group">
                  <label for="thumbnail">Unggah Thumbnail</label>
                  <input type="file" name="thumbnail" class="form-control-file">
                  @error('thumbnail')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                {{-- Status --}}
                <div class="form-group">
                  <label for="status">Status</label>
                  <select name="status" class="form-control">
                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                    <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                  </select>
                  @error('status')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                {{-- Featured --}}
                <div class="form-group">
                  <label for="is_featured">Tampilkan di Beranda?</label>
                  <select name="is_featured" class="form-control">
                    <option value="0" {{ old('is_featured') == '0' ? 'selected' : '' }}>Tidak</option>
                    <option value="1" {{ old('is_featured') == '1' ? 'selected' : '' }}>Ya</option>
                  </select>
                  @error('is_featured')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                {{-- Tanggal Publikasi --}}
                <div class="form-group">
                  <label for="published_at">Tanggal Publikasi</label>
                  <input type="datetime-local" name="published_at" class="form-control"
                    value="{{ old('published_at') }}">
                  @error('published_at')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>

            </div>
          </div>
        </div>
      </form>
    </div>
  </section>
</div>

@endsection
