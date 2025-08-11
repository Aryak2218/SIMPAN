@extends('backend.layout.main')
@section('content')

<div class="content-wrapper">
  <!-- Content Header -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Edit Dokumen SPBE</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('spbe.index') }}">Back</a></li>
            <li class="breadcrumb-item active">Edit Dokumen SPBE</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <form action="{{ route('spbe.update', $spbe->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
          <div class="col-md-8">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form Edit Dokumen SPBE</h3>
              </div>

              <div class="card-body">
                <div class="form-group">
                  <label for="judul">Judul</label>
                  <input type="text" name="judul" class="form-control" value="{{ old('judul', $spbe->judul) }}" placeholder="Masukkan Judul">
                  @error('judul') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                  <label for="penulis">Penulis</label>
                  <input type="text" name="penulis" class="form-control" value="{{ old('penulis', $spbe->penulis) }}" placeholder="Masukkan Penulis">
                  @error('penulis') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                  <label for="instansi">Instansi</label>
                  <input type="text" name="instansi" class="form-control" value="{{ old('instansi', $spbe->instansi) }}" placeholder="Masukkan Instansi">
                  @error('instansi') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                  <label for="deskripsi">Deskripsi</label>
                  <textarea name="deskripsi" class="form-control" rows="3" placeholder="Masukkan Deskripsi">{{ old('deskripsi', $spbe->deskripsi) }}</textarea>
                  @error('deskripsi') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                  <label for="waktu">Waktu</label>
                  <input type="date" name="waktu" class="form-control" value="{{ old('waktu', $spbe->waktu) }}">
                  @error('waktu') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                  <label for="format">Format</label>
                  <input type="text" name="format" class="form-control" value="{{ old('format', $spbe->format) }}" placeholder="Contoh: PDF, DOCX, JPG">
                  @error('format') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                  <label for="lingkup">Lingkup</label>
                  <input type="text" name="lingkup" class="form-control" value="{{ old('lingkup', $spbe->lingkup) }}" placeholder="Masukkan Lingkup">
                  @error('lingkup') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                  <label for="label">Label</label>
                  <input type="text" name="label" class="form-control" value="{{ old('label', $spbe->label) }}" placeholder="Masukkan Label">
                  @error('label') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                  <label for="kontributor">Kontributor</label>
                  <input type="text" name="kontributor" class="form-control" value="{{ old('kontributor', $spbe->kontributor) }}" placeholder="Masukkan Kontributor">
                  @error('kontributor') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                  <label for="status_publikasi">Status Publikasi</label>
                  <select name="status_publikasi" class="form-control">
                    <option value="">-- Pilih Status --</option>
                    <option value="Publik" {{ old('status_publikasi', $spbe->status_publikasi) == 'Publik' ? 'selected' : '' }}>Publik</option>
                    <option value="Privat" {{ old('status_publikasi', $spbe->status_publikasi) == 'Privat' ? 'selected' : '' }}>Privat</option>
                  </select>
                  @error('status_publikasi') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label for="url">URL</label>
                    <input type="text" name="url" class="form-control" value="{{ old('url', $spbe->url) }}" placeholder="Masukkan URL jika ada">
                    @error('url') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                  <label for="file_dokumen">Ganti File Dokumen (Opsional)</label>
                  <input type="file" name="file_dokumen" class="form-control-file">
                  <small class="text-muted">Kosongkan jika tidak ingin mengganti file.</small>
                  @error('file_dokumen') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </section>
</div>

@endsection
