<!DOCTYPE html>
<html lang="en">

<head>
    @include('template.head')
    <style>
        .card-icon {
            font-size: 2rem;
            color: #ffffff;
        }

        .carousel-item img {
            height: 400px;
            object-fit: cover;
        }
    </style>
</head>

<body>
    @include('template.header')
    @include('template.sidebar')

    <main id="main" class="main" style="padding-top: 80px;">
        <div class="pagetitle">
            <h1>Dashboard Perpustakaan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div>

        <!-- Statistik -->
        <div class="row">
            <div class="col-md-3">
                <div class="card bg-primary text-white p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5>Total Buku</h5>
                            <h2>{{ $totalBuku }}</h2>
                        </div>
                        <i class="bi bi-book card-icon"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5>Total Peminjam</h5>
                            <h2>{{ $totalPeminjam }}</h2>
                        </div>
                        <i class="bi bi-people card-icon"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-white p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5>Buku Dipinjam</h5>
                            <h2>{{ $totalBukuDipinjam }}</h2>
                        </div>
                        <i class="bi bi-arrow-right-circle card-icon"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-danger text-white p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5>Buku Kembali</h5>
                            <h2>{{ $totalBukuKembali }}</h2>
                        </div>
                        <i class="bi bi-arrow-left-circle card-icon"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Buku Terbaru -->
        <div class="row mt-4">
            <!-- Carousel Sampul Buku -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">Sampul Buku Terbaru</div>
                    <div class="card-body">
                        @if ($bukuTerbaru->isEmpty())
                            <p class="text-center">Belum ada buku terbaru.</p>
                        @else
                            <div id="bookCarousel" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach ($bukuTerbaru as $index => $buku)
                                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/cover/' . $buku->cover) }}" class="d-block w-100" alt="{{ $buku->Judul }}">

                                        </div>
                                    @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#bookCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#bookCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- List Buku Terbaru -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-success text-white">Buku Terbaru</div>
                    <div class="card-body">
                        @if ($bukuTerbaru->isEmpty())
                            <p class="text-center">Belum ada buku terbaru.</p>
                        @else
                            <ul class="list-group">
                                @foreach ($bukuTerbaru as $buku)
                                    <li class="list-group-item">{{ $buku->judul }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('template.footer')
    @include('template.script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
