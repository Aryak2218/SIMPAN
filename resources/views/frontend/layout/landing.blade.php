<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>SIMPAN LOMBOK BARAT</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="SPBE Knowledge Sharing Platform" name="keywords">
    <meta content="Browse and download SPBE documents" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('edu/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('edu/css/style.css') }}" rel="stylesheet">
</head>

<body>

<!-- Navbar Start -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0 px-lg-5">
            <a href="{{ route('landing') }}" class="navbar-brand ml-lg-3">
                <h1 class="m-0 text-uppercase text-primary"><i class="fa fa-book-reader mr-3"></i>SIMPAN LOMBOK BARAT</h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Dropdown untuk Kategori -->
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Kategori</a>
                <div class="dropdown-menu m-0">
                    @foreach($kategori as $kat)
                        <a href="#" class="dropdown-item">{{ $kat->nama_kategori }}</a>
                    @endforeach
                </div>
            </div>

            <!-- Dropdown untuk Tag -->
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Tipe</a>
                <div class="dropdown-menu m-0">
                    @foreach($tags as $tag)
                        <a href="#" class="dropdown-item">{{ $tag->nama_tag }}</a>
                    @endforeach
                </div>
            </div>

            <div class="collapse navbar-collapse justify-content-between px-lg-3" id="navbarCollapse">
                <div class="navbar-nav ml-auto">
                    <!-- Tombol Login -->
                    <a href="{{ route('login') }}" class="btn btn-info ml-2">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </a>
                    <!-- Tombol Register -->
                    <a href="{{ route('register') }}" class="btn btn-info ml-2">
                        <i class="fas fa-edit"></i> Register
                    </a>
                </div>
            </div>
        </nav>
    </div>
<!-- Navbar End -->

<!-- Header Start -->
    <div class="jumbotron jumbotron-fluid position-relative overlay-bottom" style="margin-bottom: 90px;">
        <div class="container text-center my-5 py-5">
            <h3 class="text-white display-2 mb-1">SIMPAN LOMBOK BARAT</h3>
            <h4 class="text-white mt-4 mb-2">SIMPAN (Sistem Informasi Manajemen Pengetahuan Nasional) LOMBOK BARAT</h4>
            <h5 class="text-white mt-4 mb-5">Platform berbasis web yang dirancang untuk mengelola, menyimpan, dan berbagi pengetahuan terkait dengan Sistem Pemerintahan Berbasis Elektronik (SPBE) untuk meningkatkan kinerja pemerintah dan kualitas layanan publik
            </h5>
            <!-- Form Pencarian -->
            <form action="{{ route('landing') }}" method="GET" class="mx-auto mb-5" style="width: 100%; max-width: 800px;">
                <div class="input-group">
                    <input type="text" name="search" class="form-control border-light" style="padding: 30px 25px;" placeholder="Cari Pengetahuan" value="{{ request()->get('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-secondary px-4 px-lg-5">Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<!-- Header End -->

<!-- SPBE Articles Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="section-title text-center mb-5">
            <h2 class="d-inline-block position-relative text-uppercase pb-2" style="color: #007BFF;">Pengetahuan Terbaru</h2>
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

<!-- Footer Start -->
    <div class="container-fluid position-relative overlay-top bg-dark text-white-50 py-5" style="margin-top: 90px;">
        <div class="container mt-5 pt-5">
            <div class="row">
                <div class="col-md-6 mb-5">
                    <a href="{{ route('landing') }}" class="navbar-brand">
                        <h1 class="mt-n2 text-uppercase text-white"><i class="fa fa-book-reader mr-3"></i>SIMPAN LOMBOK BARAT</h1>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-5">
                    <h3 class="text-white mb-4">Tentang Kami</h3>
                    <p class="fs-2"><i class="fa fa-map-marker-alt mr-2"></i>Dasan Geres, Kec. Gerung, Kabupaten Lombok Barat, Nusa Tenggara Barat.</p>
                    <p class="fs-2"><i class="fa fa-envelope mr-2"></i>diskominfo@lombokbaratkab.go.id</p>
                    <p class="fs-2"><i class="fas fa-globe mr-2"></i></i>www.diskominfo.lombokbaratkab.go.id</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('edu/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('edu/js/main.js') }}"></script>
</body>

</html>
