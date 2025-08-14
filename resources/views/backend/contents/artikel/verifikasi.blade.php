@extends('backend.layout.main')

@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Verifikasi Artikel</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Artikel yang Perlu Diverifikasi</h3>
                </div>

                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Penulis</th>
                                <th>Excerpt</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($artikel as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->judul }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ Str::limit($item->excerpt, 100) }}</td>
                                <td>{{ ucfirst($item->status) }}</td>
                                <td>
                                    <a href="{{ route('artikel.show', $item->id) }}" class="btn btn-primary">Lihat</a>
                                    <a href="{{ route('artikel.publish', $item->id) }}" class="btn btn-success">Publish</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $artikel->links() }}
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
