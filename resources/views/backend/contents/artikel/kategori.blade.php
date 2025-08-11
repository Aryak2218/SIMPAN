@extends('backend.layout.main')
@section('content')

<div class="content-wrapper">
  <!-- Content Header -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Kategori Artikel</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Kategori Artikel</li>
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
          <a href="{{ route('kategori.create') }}" class="btn btn-primary mb-3">Tambah Kategori</a>
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Daftar Kategori</h3>
            </div>

            <!-- Card Body -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Slug</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($kategori as $item)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_kategori }}</td>
                    <td>{{ $item->slug }}</td>
                    <td>
                      <a href="{{ route('kategori.edit', $item->id) }}" class="btn btn-info btn">
                        <i class="fas fa-edit"> Edit </i>
                      </a>
                      <button class="btn btn-danger btn" data-toggle="modal" data-target="#modal-hapus{{ $item->id }}">
                        <i class="fas fa-trash"> Hapus </i>
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
                          <p>Yakin ingin menghapus kategori <b>{{ $item->nama }}</b>?</p>
                        </div>
                        <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Batal</button>
                          <form action="{{ route('kategori.destroy', $item->id) }}" method="POST">
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
