@extends('backend.layout.main')

@section('content')
<div class="content-wrapper">
  <!-- Header -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Detail Dokumen</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('spbe.index') }}">Daftar Dokumen</a></li>
            <li class="breadcrumb-item active">Detail</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header bg-primary text-white">
          <h3 class="card-title">Informasi Dokumen</h3>
        </div>
        <div class="card-body">
          <table class="table table-bordered">
            <tr>
              <th width="30%">Nomor ID</th>
              <td>{{ $artikel->nomor_id }}</td>
            </tr>
            <tr>
              <th>Judul</th>
              <td>{{ $artikel->judul }}</td>
            </tr>
            <tr>
              <th>Penulis</th>
              <td>{{ $artikel->penulis->name ?? 'Tidak ada penulis' }}</td>
            </tr>
            <tr>
              <th>Instansi</th>
              <td>{{ $artikel->instansi }}</td>
            </tr>
            <tr>
              <th>Deskripsi</th>
              <td>{{ $artikel->deskripsi }}</td>
            </tr>
            <tr>
              <th>Tanggal Periode</th>
              <td>{{ $artikel->waktu }}</td>
            </tr>
            <tr>
              <th>Format</th>
              <td>{{ $artikel->format }}</td>
            </tr>
            <tr>
              <th>Lingkup</th>
              <td>{{ $artikel->lingkup }}</td>
            </tr>
            <tr>
              <th>Label</th>
              <td>{{ $artikel->label }}</td>
            </tr>
            <tr>
              <th>Kontributor</th>
              <td>{{ $artikel->kontributor }}</td>
            </tr>
            <tr>
              <th>Status Publikasi</th>
              <td>{{ ucfirst($artikel->status_publikasi) }}</td>
            </tr>
            <tr>
              <th>URL</th>
              <td>
                @if($artikel->url)
                  <a href="{{ $artikel->url }}" target="_blank">Lihat URL</a>
                @else
                  <span>-</span>
                @endif
              </td>
            </tr>
            <tr>
              <th>File Dokumen</th>
              <td>
                @if($artikel->file_path)
                  <a href="{{ asset('storage/' . $artikel->file_path) }}" target="_blank" class="btn btn-sm btn-success mt-2">
                    <i class="fas fa-download"></i> Download
                  </a>
                @else
                  <span>Tidak ada file</span>
                @endif
              </td>
            </tr>
          </table>
        </div>
        <div class="card-footer">
          <a href="{{ route('spbe.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
          </a>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
