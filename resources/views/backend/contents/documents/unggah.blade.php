@extends('backend.layout.main')
@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Pengetahuan SPBE</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Pengetahuan SPBE</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-12">
        <a href="{{ route('spbe.create') }}" class="btn btn-primary mb-3">Tambah Data</a>
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Daftar Pengetahuan SPBE</h3>
            <div class="card-tools">
              <form action="{{ route('spbe.index') }}" method="GET">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control float-right" placeholder="Search" value="{{ request()->get('table_search') }}">
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>

          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Judul</th>
                  <th>Penulis</th>
                  <th>Instansi</th>
                  <th>Deskripsi</th>
                  <th>Waktu</th>
                  <th>Format</th>
                  <th>Lingkup</th>
                  <th>Label</th>
                  <th>Kontributor</th>
                  <th>Status Publikasi</th>
                  <th>URL</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($spbe as $item)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $item->judul }}</td>
                  <td>{{ $item->penulis->name ?? '-' }}</td>
                  <td>{{ $item->instansi }}</td>
                  <td>{{ Str::limit(strip_tags($item->deskripsi), 50) }}</td>
                  <td>{{ $item->waktu }}</td>
                  <td>{{ $item->format }}</td>
                  <td>{{ $item->lingkup }}</td>
                  <td>{{ $item->label }}</td>
                  <td>{{ $item->kontributor }}</td>
                  <td>{{ ucfirst($item->status_publikasi) }}</td>
                  <td><a href="{{ $item->url }}" target="_blank">Lihat</a></td>
                  <td>
                    <a href="{{ route('spbe.show', $item->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-eye"></i> View</a>
                    <a href="{{ route('spbe.edit', $item->id) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i> Edit</a>
                    <a data-toggle="modal" data-target="#modal-hapus{{ $item->id }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</a>
                  </td>
                </tr>

                <!-- Modal Hapus -->
                <div class="modal fade" id="modal-hapus{{ $item->id }}">
                  <div class="modal-dialog">
                    <div class="modal-content bg-warning">
                      <div class="modal-header">
                        <h4 class="modal-title">Konfirmasi Hapus</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p>Apakah Anda yakin ingin menghapus <strong>{{ $item->judul }}</strong>?</p>
                      </div>
                      <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Batal</button>
                        <form action="{{ route('spbe.destroy', $item->id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-outline-danger">Ya, Hapus</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /Modal Hapus -->
                @endforeach
              </tbody>
            </table>
            <!-- Pagination -->
            <div class="d-flex justify-content-center">
              {{ $spbe->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

@endsection
