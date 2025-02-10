<!DOCTYPE html>
<html lang="id">

<head>
    @include('template.head')
    <style>
        .book-card {
            transition: transform 0.2s;
        }

        .book-card:hover {
            transform: scale(1.05);
        }

        .book-cover {
            height: 250px;
            object-fit: cover;
        }
    </style>
</head>

<body>
    @include('template.header')
    @include('template.sidebar')

    <main id="main" class="main" style="padding-top: 80px;">
        <div class="pagetitle d-flex justify-content-between align-items-center">
            <h1>Data Buku</h1>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahBukuModal">Tambah Buku</button>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    var myModal = new bootstrap.Modal(document.getElementById('tambahBukuModal'));
                    myModal.show();
                });
            </script>
        @endif

        <div class="row mt-4">
            @foreach($buku as $item)
                <div class="col-md-3 mb-4">
                    <div class="card book-card">
                        <img src="{{ $item->cover ? asset('storage/' . $item->cover) : asset('images/default-cover.jpg') }}" class="card-img-top book-cover" alt="{{ $item->judul ?? 'Default Cover' }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->judul }}</h5>
                            <p class="card-text text-muted">{{ $item->penulis }}</p>
                            <p class="card-text"><small>Penerbit: {{ $item->penerbit }}</small></p>
                            <p class="card-text"><small>Tahun Terbit: {{ $item->tahun_terbit }}</small></p>
                            <a href="{{ route('admin.buku.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.buku.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </main>

    <div class="modal fade" id="tambahBukuModal" tabindex="-1" aria-labelledby="tambahBukuModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahBukuModalLabel">Tambah Buku</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.buku.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul Buku</label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" value="{{ old('judul') }}" required>
                            @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="penulis" class="form-label">Penulis</label>
                            <input type="text" class="form-control @error('penulis') is-invalid @enderror" name="penulis" value="{{ old('penulis') }}" required>
                            @error('penulis')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="penerbit" class="form-label">Penerbit</label>
                            <input type="text" class="form-control @error('penerbit') is-invalid @enderror" name="penerbit" value="{{ old('penerbit') }}" required>
                            @error('penerbit')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                            <input type="number" class="form-control @error('tahun_terbit') is-invalid @enderror" name="tahun_terbit" value="{{ old('tahun_terbit') }}" required>
                            @error('tahun_terbit')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="cover" class="form-label">Sampul Buku</label>
                            <input type="file" class="form-control @error('cover') is-invalid @enderror" name="cover" accept="image/*">
                            @error('cover')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('template.script')
</body>

</html>
