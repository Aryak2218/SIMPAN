@extends('backend.layout.main')
@section('content')

<div class="content-wrapper">
  <!-- Content Header -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Manajemen Artikel</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Artikel</li>
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
          <a href="{{ route('artikel.create') }}" class="btn btn-primary mb-3">Tambah Artikel</a>
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Daftar Artikel</h3>
              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Card Body -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Thumbnail</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Penulis</th>
                    <th>Excerpt</th>
                    <th>Status</th>
                    <th>Featured</th>
                    <th>Dipublikasikan</th>
                    <th>View</th>
                    <th>SPBE ID</th> <!-- Tambahkan kolom SPBE ID -->
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($artikel as $item)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                      {{-- Cek dan tampilkan gambar jika file ada --}}
                      @if($item->thumbnail && file_exists(public_path($item->thumbnail)))
                          <img src="{{ asset($item->thumbnail) }}" width="80">
                      @else
                          <span class="text-danger">Gambar Tidak Tersedia</span>
                      @endif
                  </td>
                    <td>{{ $item->judul }}</td>
                    <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                    <td>{{ $item->user->name ?? '-' }}</td>
                    <td>{{ Str::limit($item->excerpt, 100) }}</td>
                    <td>{{ ucfirst($item->status) }}</td>
                    <td>{{ $item->is_featured ? 'Ya' : 'Tidak' }}</td>
                    <td>{{ $item->published_at ? $item->published_at->format('d M Y H:i') : '-' }}</td>
                    <td>{{ $item->view_count }}</td>
                    <td>{{ $item->spbe_id ?? '-' }}</td>
                    <td>
                      <a href="#" class="btn btn-warning">
                        <i class="fas fa-eye"></i> View
                      </a>
                      <a href="{{ route('artikel.edit', $item->id) }}" class="btn btn-info">
                        <i class="fas fa-edit"></i> Edit
                      </a>
                      <button class="btn btn-danger" data-toggle="modal" data-target="#modal-hapus{{ $item->id }}">
                        <i class="fas fa-trash"></i> Hapus
                      </button>
                    </td>
                  </tr>

                  <!-- Modal Hapus -->
                  <div class="modal fade" id="modal-hapus{{ $item->id }}">
                    <div class="modal-dialog">
                      <div class="modal-content bg-warning">
                        <div class="modal-header">
                          <h4 class="modal-title">Konfirmasi Hapus Artikel</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p>Yakin ingin menghapus artikel berjudul <b>{{ $item->judul }}</b>?</p>
                        </div>
                        <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
                          <form action="{{ route('artikel.destroy', $item->id) }}" method="POST">
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
