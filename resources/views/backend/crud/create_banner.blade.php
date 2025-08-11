@extends('backend.layout.main')
@section('content')

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Tambah Banner Artikel</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('banner') }}">Back</a></li>
            <li class="breadcrumb-item active">Tambah Banner</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <form action="{{ route('banner.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-md-8">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form Tambah Banner</h3>
              </div>

              <div class="card-body">

                {{-- Artikel --}}
                <div class="form-group">
                  <label for="artikel_id">Pilih Artikel</label>
                  <select name="artikel_id" class="form-control">
                    <option value="">-- Pilih Artikel --</option>
                    @foreach ($artikel as $artikel)
                      <option value="{{ $artikel->id }}" {{ old('artikel_id') == $artikel->id ? 'selected' : '' }}>
                        {{ $artikel->judul }}
                      </option>
                    @endforeach
                  </select>
                  @error('artikel_id')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                {{-- Judul Teks --}}
                <div class="form-group">
                  <label for="judul_teks">Judul Teks</label>
                  <input type="text" name="judul_teks" class="form-control" value="{{ old('judul_teks') }}">
                  @error('judul_teks')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                {{-- Subjudul Teks --}}
                <div class="form-group">
                  <label for="subjudul_teks">Subjudul Teks</label>
                  <textarea name="subjudul_teks" class="form-control" rows="3">{{ old('subjudul_teks') }}</textarea>
                  @error('subjudul_teks')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                {{-- Gambar --}}
                <div class="form-group">
                  <label for="gambar">Unggah Gambar</label>
                  <input type="file" name="gambar" class="form-control-file">
                  @error('gambar')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                {{-- Urutan --}}
                <div class="form-group">
                  <label for="urutan">Urutan Banner</label>
                  <input type="number" name="urutan" class="form-control" value="{{ old('urutan') }}">
                  @error('urutan')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                {{-- Aktif --}}
                <div class="form-group">
                  <label for="aktif">Status Aktif</label>
                  <select name="aktif" class="form-control">
                    <option value="1" {{ old('aktif') == '1' ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ old('aktif') == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                  </select>
                  @error('aktif')<small class="text-danger">{{ $message }}</small>@enderror
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
