@extends('frontend.layout.landing')  <!-- Menggunakan layout frontend -->
@section('title', 'Landing Page')

@section('content')
    <!-- SPBE Articles Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="section-title text-center mb-5">
            <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">Pengetahuan Terbaru</h6>
            <h1 class="display-4">Cari Artikel Pengetahuan</h1>
        </div>
        <div class="row">
           @foreach ($artikel as $item)
                @if ($item instanceof \App\Models\Artikel) <!-- Pastikan item adalah objek Artikel -->
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card">
                            <!-- Cek apakah artikel memiliki thumbnail -->
                            @if ($item->thumbnail && file_exists(public_path($item->thumbnail)))
                                <img src="{{ asset($item->thumbnail) }}" class="card-img-top" alt="article thumbnail">
                            @else
                                <div class="card-img-top" style="background-color: #f0f0f0; height: 180px; display: flex; justify-content: center; align-items: center;">
                                    <span>No Thumbnail Available</span>  <!-- Tampilkan teks jika tidak ada thumbnail -->
                                </div>
                            @endif

                            <div class="card-body">
                                <h5 class="card-title">{{ $item->judul }}</h5>
                                <p class="card-text">{{ Str::limit($item->excerpt, 100) }}</p>
                                <a href="{{ route('artikel.show', $item->id) }}" class="btn btn-primary">Read More</a>
                                @if ($item->spbe && $item->spbe->file_path)
                                    <a href="{{ asset('storage/' . $item->spbe->file_path) }}" target="_blank" class="btn btn-success mt-2">
                                        <i class="fas fa-download"></i> Download Document
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Jika $item bukan objek Artikel, tampilkan error atau abaikan -->
                    <p>Artikel tidak ditemukan atau ada masalah dengan data.</p>
                @endif
            @endforeach

        </div>
    </div>
</div>
<!-- SPBE Articles End -->
@endsection
