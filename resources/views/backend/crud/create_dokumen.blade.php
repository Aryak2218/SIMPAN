@extends('backend.layout.main')
@section('content')

<div class="content-wrapper">
  <!-- Content Header -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Unggah Dokumen SPBE</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('spbe.index') }}">Back</a></li>
            <li class="breadcrumb-item active">Unggah SPBE</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <form action="{{ route('spbe.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-md-8">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form Unggah Dokumen SPBE</h3>
              </div>

              <div class="card-body">
                <!-- Nomor ID otomatis -->
                <div class="form-group">
                  <label for="nomor_id">Nomor ID</label>
                  <input type="text" name="nomor_id" class="form-control" value="{{ $nomorId }}" readonly>
                </div>

                <!-- Kategori Dropdown -->
                <div class="form-group">
                  <label for="kategori_id">Kategori</label>
                  <select name="kategori_id" class="form-control" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategori as $k)
                      <option value="{{ $k->id }}" {{ old('kategori_id') == $k->id ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                    @endforeach
                  </select>
                  @error('kategori_id')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>

                <!-- Judul -->
                <div class="form-group">
                  <label for="judul">Judul</label>
                  <input type="text" name="judul" class="form-control" value="{{ old('judul') }}" placeholder="Masukkan Judul" required>
                  @error('judul')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>

                <!-- Instansi -->
                <div class="form-group">
                <label for="instansi">Instansi</label>
                <select name="instansi" class="form-control" required>
                    <option value="">Pilih Instansi</option>
                    <option value="Sekretariat Daerah" {{ old('instansi') == 'Sekretariat Daerah' ? 'selected' : '' }}>Sekretariat Daerah</option>
                    <option value="Sekretariat Dewan Perwakilan Rakyat Daerah" {{ old('instansi') == 'Sekretariat Dewan Perwakilan Rakyat Daerah' ? 'selected' : '' }}>Sekretariat Dewan Perwakilan Rakyat Daerah</option>
                    <option value="Inspektorat Kabupaten" {{ old('instansi') == 'Inspektorat Kabupaten' ? 'selected' : '' }}>Inspektorat Kabupaten</option>
                    <option value="Dinas Pendidikan dan Kebudayaan" {{ old('instansi') == 'Dinas Pendidikan dan Kebudayaan' ? 'selected' : '' }}>Dinas Pendidikan dan Kebudayaan</option>
                    <option value="Dinas Kesehatan" {{ old('instansi') == 'Dinas Kesehatan' ? 'selected' : '' }}>Dinas Kesehatan</option>
                    <option value="Dinas Sosial" {{ old('instansi') == 'Dinas Sosial' ? 'selected' : '' }}>Dinas Sosial</option>
                    <option value="Dinas Pekerjaan Umum dan Penataan Ruang" {{ old('instansi') == 'Dinas Pekerjaan Umum dan Penataan Ruang' ? 'selected' : '' }}>Dinas Pekerjaan Umum dan Penataan Ruang</option>
                    <option value="Dinas Perumahan dan Permukiman" {{ old('instansi') == 'Dinas Perumahan dan Permukiman' ? 'selected' : '' }}>Dinas Perumahan dan Permukiman</option>
                    <option value="Satuan Polisi Pamong Praja" {{ old('instansi') == 'Satuan Polisi Pamong Praja' ? 'selected' : '' }}>Satuan Polisi Pamong Praja</option>
                    <option value="Dinas Pemadam Kebakaran" {{ old('instansi') == 'Dinas Pemadam Kebakaran' ? 'selected' : '' }}>Dinas Pemadam Kebakaran</option>
                    <option value="Dinas Perhubungan" {{ old('instansi') == 'Dinas Perhubungan' ? 'selected' : '' }}>Dinas Perhubungan</option>
                    <option value="Dinas Komunikasi, Informatika dan Statistik" {{ old('instansi') == 'Dinas Komunikasi, Informatika dan Statistik' ? 'selected' : '' }}>Dinas Komunikasi, Informatika dan Statistik</option>
                    <option value="Dinas Kependudukan dan Pencatatan Sipil" {{ old('instansi') == 'Dinas Kependudukan dan Pencatatan Sipil' ? 'selected' : '' }}>Dinas Kependudukan dan Pencatatan Sipil</option>
                    <option value="Dinas Koperasi, Usaha Kecil dan Menengah" {{ old('instansi') == 'Dinas Koperasi, Usaha Kecil dan Menengah' ? 'selected' : '' }}>Dinas Koperasi, Usaha Kecil dan Menengah</option>
                    <option value="Dinas Kearsipan dan Perpustakaan" {{ old('instansi') == 'Dinas Kearsipan dan Perpustakaan' ? 'selected' : '' }}>Dinas Kearsipan dan Perpustakaan</option>
                    <option value="Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu" {{ old('instansi') == 'Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu' ? 'selected' : '' }}>Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu</option>
                    <option value="Dinas Pengendalian Penduduk, Keluarga Berencana, Pemberdayaan Perempuan dan Perlindungan Anak" {{ old('instansi') == 'Dinas Pengendalian Penduduk, Keluarga Berencana, Pemberdayaan Perempuan dan Perlindungan Anak' ? 'selected' : '' }}>Dinas Pengendalian Penduduk, Keluarga Berencana, Pemberdayaan Perempuan dan Perlindungan Anak</option>
                    <option value="Dinas Pemberdayaan Masyarakat dan Desa" {{ old('instansi') == 'Dinas Pemberdayaan Masyarakat dan Desa' ? 'selected' : '' }}>Dinas Pemberdayaan Masyarakat dan Desa</option>
                    <option value="Dinas Lingkungan Hidup" {{ old('instansi') == 'Dinas Lingkungan Hidup' ? 'selected' : '' }}>Dinas Lingkungan Hidup</option>
                    <option value="Dinas Pemuda dan Olah Raga" {{ old('instansi') == 'Dinas Pemuda dan Olah Raga' ? 'selected' : '' }}>Dinas Pemuda dan Olah Raga</option>
                    <option value="Dinas Pariwisata" {{ old('instansi') == 'Dinas Pariwisata' ? 'selected' : '' }}>Dinas Pariwisata</option>
                    <option value="Dinas Kelautan dan Perikanan" {{ old('instansi') == 'Dinas Kelautan dan Perikanan' ? 'selected' : '' }}>Dinas Kelautan dan Perikanan</option>
                    <option value="Dinas Pertanian" {{ old('instansi') == 'Dinas Pertanian' ? 'selected' : '' }}>Dinas Pertanian</option>
                    <option value="Dinas Ketahanan Pangan" {{ old('instansi') == 'Dinas Ketahanan Pangan' ? 'selected' : '' }}>Dinas Ketahanan Pangan</option>
                    <option value="Dinas Perindustrian dan Perdagangan" {{ old('instansi') == 'Dinas Perindustrian dan Perdagangan' ? 'selected' : '' }}>Dinas Perindustrian dan Perdagangan</option>
                    <option value="Dinas Tenaga Kerja" {{ old('instansi') == 'Dinas Tenaga Kerja' ? 'selected' : '' }}>Dinas Tenaga Kerja</option>
                    <option value="Badan Perencanaan Pembangunan Daerah" {{ old('instansi') == 'Badan Perencanaan Pembangunan Daerah' ? 'selected' : '' }}>Badan Perencanaan Pembangunan Daerah</option>
                    <option value="Badan Kepegawaian Daerah dan Pengembangan Sumber Daya Manusia" {{ old('instansi') == 'Badan Kepegawaian Daerah dan Pengembangan Sumber Daya Manusia' ? 'selected' : '' }}>Badan Kepegawaian Daerah dan Pengembangan Sumber Daya Manusia</option>
                    <option value="Badan Pengelolaan Keuangan dan Aset Daerah" {{ old('instansi') == 'Badan Pengelolaan Keuangan dan Aset Daerah' ? 'selected' : '' }}>Badan Pengelolaan Keuangan dan Aset Daerah</option>
                    <option value="Badan Pendapatan Daerah" {{ old('instansi') == 'Badan Pendapatan Daerah' ? 'selected' : '' }}>Badan Pendapatan Daerah</option>
                    <option value="Badan Penanggulangan Bencana Daerah" {{ old('instansi') == 'Badan Penanggulangan Bencana Daerah' ? 'selected' : '' }}>Badan Penanggulangan Bencana Daerah</option>
                    <option value="Badan Kesatuan Bangsa dan Politik" {{ old('instansi') == 'Badan Kesatuan Bangsa dan Politik' ? 'selected' : '' }}>Badan Kesatuan Bangsa dan Politik</option>
                    <option value="Kecamatan Batu Layar" {{ old('instansi') == 'Kecamatan Batu Layar' ? 'selected' : '' }}>Kecamatan Batu Layar</option>
                    <option value="Kecamatan Gunungsari" {{ old('instansi') == 'Kecamatan Gunungsari' ? 'selected' : '' }}>Kecamatan Gunungsari</option>
                    <option value="Kecamatan Lingsar" {{ old('instansi') == 'Kecamatan Lingsar' ? 'selected' : '' }}>Kecamatan Lingsar</option>
                    <option value="Kecamatan Narmada" {{ old('instansi') == 'Kecamatan Narmada' ? 'selected' : '' }}>Kecamatan Narmada</option>
                    <option value="Kecamatan Kediri" {{ old('instansi') == 'Kecamatan Kediri' ? 'selected' : '' }}>Kecamatan Kediri</option>
                    <option value="Kecamatan Labuapi" {{ old('instansi') == 'Kecamatan Labuapi' ? 'selected' : '' }}>Kecamatan Labuapi</option>
                    <option value="Kecamatan Kuripan" {{ old('instansi') == 'Kecamatan Kuripan' ? 'selected' : '' }}>Kecamatan Kuripan</option>
                    <option value="Kecamatan Gerung" {{ old('instansi') == 'Kecamatan Gerung' ? 'selected' : '' }}>Kecamatan Gerung</option>
                    <option value="Kecamatan Lembar" {{ old('instansi') == 'Kecamatan Lembar' ? 'selected' : '' }}>Kecamatan Lembar</option>
                    <option value="Kecamatan Sekotong" {{ old('instansi') == 'Kecamatan Sekotong' ? 'selected' : '' }}>Kecamatan Sekotong</option>
                    <option value="Puskesmas Banyumulek" {{ old('instansi') == 'Puskesmas Banyumulek' ? 'selected' : '' }}>Puskesmas Banyumulek</option>
                    <!-- Add more options as needed -->
                </select>
                @error('instansi')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                </div>


<!-- Tambahkan Select2 CDN di bagian <head> HTML -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

<!-- Tambahkan script jQuery dan Select2 di bagian bawah sebelum tag </body> -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script>
  $(document).ready(function() {
    // Inisialisasi Select2 untuk dropdown instansi
    $('#instansi').select2({
      placeholder: "Pilih Instansi",  // Placeholder untuk dropdown
      allowClear: true,  // Menambahkan tombol clear (hapus pilihan)
    });
  });
</script>



                <!-- Deskripsi -->
                <div class="form-group">
                  <label for="deskripsi">Deskripsi</label>
                  <textarea name="deskripsi" class="form-control" rows="4" placeholder="Masukkan Deskripsi">{{ old('deskripsi') }}</textarea>
                  @error('deskripsi')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>

                <!-- Waktu -->
                <div class="form-group">
                  <label for="waktu">Waktu</label>
                  <input type="date" name="waktu" class="form-control" value="{{ old('waktu') }}" required>
                  @error('waktu')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>

                <!-- Format -->
                <div class="form-group">
                <label for="format">Format</label>
                <select name="format" class="form-control" required>
                    <option value="PDF" {{ old('format') == 'PDF' ? 'selected' : '' }}>PDF</option>
                    <option value="Word" {{ old('format') == 'Word' ? 'selected' : '' }}>Word</option>
                    <option value="Excel" {{ old('format') == 'Excel' ? 'selected' : '' }}>Excel</option>
                    <option value="Video" {{ old('format') == 'Video' ? 'selected' : '' }}>Video</option>
                </select>
                @error('format')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                </div>

                <!-- Lingkup -->
                <div class="form-group">
                <label for="lingkup">Lingkup</label>
                <input type="text" name="lingkup" class="form-control" value="{{ old('lingkup') }}" placeholder="Masukkan Lingkung (jika ada)">
                @error('lingkup')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                </div>


                <!-- Label -->
                <div class="form-group">
                <label for="label">Label</label>
                <input type="text" name="label" class="form-control" value="{{ old('label') }}" placeholder="Masukkan Label (jika ada)">
                @error('label')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                </div>


                <!-- Kontributor -->
                <div class="form-group">
                <label for="kontributor">Kontributor</label>
                <input type="text" name="kontributor" class="form-control" value="{{ old('kontributor') }}" placeholder="Masukkan Nama Kontributor (jika ada)">
                @error('kontributor')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                </div>


                <!-- Status Publikasi -->
                <div class="form-group">
                  <label for="status_publikasi">Status Publikasi</label>
                  <select name="status_publikasi" class="form-control" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="publik" {{ old('status_publikasi') == 'publik' ? 'selected' : '' }}>Publik</option>
                    <option value="internal" {{ old('status_publikasi') == 'internal' ? 'selected' : '' }}>Internal</option>
                  </select>
                  @error('status_publikasi')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>

                <!-- URL -->
                <div class="form-group">
                  <label for="url">URL</label>
                  <input type="url" name="url" class="form-control" value="{{ old('url') }}" placeholder="Masukkan URL Dokumen (jika ada)">
                  @error('url')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>

                <!-- Unggah File -->
                <div class="form-group">
                  <label for="file_path">Unggah File Dokumen</label>
                  <input type="file" name="file_path" class="form-control-file" required>
                  @error('file_path')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Unggah</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </section>
</div>

@endsection
