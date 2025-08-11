@extends('backend.layout.main')
@section('content')

<div class="content-wrapper">
  <!-- Content Header -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Banner Artikel</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('banner') }}">Back</a></li>
            <li class="breadcrumb-item active">Banner Artikel</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <a href="{{ route('banner.create') }}" class="btn btn-primary mb-3">Tambah Banner</a>
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Daftar Banner</h3>
            </div>

            <!-- Card Body -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Judul Artikel</th>
                    <th>Judul Banner</th>
                    <th>Subjudul</th>
                    <th>Gambar</th>
                    <th>Urutan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($banner as $item)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->artikel->judul ?? '-' }}</td>
                    <td>{{ $item->judul_teks ?? '-' }}</td>
                    <td>{{ $item->subjudul_teks ?? '-' }}</td>
                    <td>
                      @if($item->gambar)
                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="Banner" width="80">
                      @else
                        <span class="text-muted">Tidak ada gambar</span>
                      @endif
                    </td>
                    <td>{{ $item->urutan }}</td>
                    <td>
                      <span class="badge badge-{{ $item->aktif ? 'success' : 'secondary' }}">
                        {{ $item->aktif ? 'Aktif' : 'Nonaktif' }}
                      </span>
                    </td>
                    <td>
                      <a href="{{ route('#', $item->id) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-eye"></i>
                      </a>
                      <a href="{{ route('banner.edit', $item->id) }}" class="btn btn-info btn-sm">
                        <i class="fas fa-edit"></i>
                      </a>
                      <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-hapus{{ $item->id }}">
                        <i class="fas fa-trash"></i>
                      </button>
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
                          <p>Yakin ingin menghapus banner untuk artikel <b>{{ $item->artikel->judul ?? '-' }}</b>?</p>
                        </div>
                        <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Batal</button>
                          <form action="{{ route('banner.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">Ya, Hapus</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

@endsection
