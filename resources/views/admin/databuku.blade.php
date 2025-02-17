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
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row mt-4">
            @foreach($buku as $item)
                <div class="col-md-3 mb-4">
                    <div class="card book-card">
                        <img src="{{ $item->cover ? asset('storage/' . $item->cover) : asset('images/default-cover.jpg') }}" 
                             class="card-img-top book-cover img-fluid" 
                             alt="{{ $item->Judul }}">

                        <div class="card-body">
                            <h5 class="card-title">{{ $item->Judul }}</h5>
                            <p class="card-text text-muted">{{ $item->Penulis }}</p>
                            <p class="card-text"><small>Penerbit: {{ $item->Penerbit }}</small></p>
                            <p class="card-text"><small>Tahun Terbit: {{ $item->TahunTerbit }}</small></p>
                            <p class="card-text"><small>Kategori: {{ $item->kategori->NamaKategori ?? 'Tidak ada' }}</small></p>
                            <p class="card-text"><small>Stok: {{ $item->Stok }}</small></p>

                            <button class="btn btn-warning btn-sm editBukuBtn"
                                data-id="{{ $item->BukuID }}" 
                                data-judul="{{ $item->Judul }}"
                                data-penulis="{{ $item->Penulis }}"
                                data-penerbit="{{ $item->Penerbit }}"
                                data-tahun_terbit="{{ $item->TahunTerbit }}"
                                data-stok="{{ $item->Stok }}"
                                data-kategori_id="{{ $item->KategoriID }}"
                                data-cover="{{ $item->cover ? asset('storage/' . $item->cover) : asset('images/default-cover.jpg') }}"
                                data-bs-toggle="modal"
                                data-bs-target="#editBukuModal">
                                Edit
                            </button>

                            <form action="{{ route('admin.buku.destroy', $item->BukuID) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus buku ini?')">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </main>

    <!-- Modal Tambah Buku -->
    <div class="modal fade" id="tambahBukuModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Buku</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.buku.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Judul Buku</label>
                            <input type="text" class="form-control" name="Judul" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Penulis</label>
                            <input type="text" class="form-control" name="Penulis" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Penerbit</label>
                            <input type="text" class="form-control" name="Penerbit" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tahun Terbit</label>
                            <input type="number" class="form-control" name="TahunTerbit" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Stok</label>
                            <input type="number" class="form-control" name="Stok" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <select class="form-control" name="KategoriID" required>
                                <option value="">Pilih Kategori</option>
                                @foreach($kategori as $kat)
                                    <option value="{{ $kat->KategoriID }}">{{ $kat->NamaKategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Cover Buku</label>
                            <input type="file" class="form-control" name="cover" accept="image/*">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Buku -->
    <div class="modal fade" id="editBukuModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Buku</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editBukuForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <input type="hidden" id="editBukuId" name="BukuID">
                        
                        <div class="mb-3">
                            <label class="form-label">Judul Buku</label>
                            <input type="text" class="form-control" id="editJudul" name="Judul" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Penulis</label>
                            <input type="text" class="form-control" id="editPenulis" name="Penulis" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Penerbit</label>
                            <input type="text" class="form-control" id="editPenerbit" name="Penerbit" required>
                        </div>
                        <button type="submit" class="btn btn-success">Update Buku</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('template.script')
    @include('sweetalert::alert')

    <script>
document.querySelectorAll('.editBukuBtn').forEach(button => {
    button.addEventListener('click', function() {
        let form = document.getElementById('editBukuForm');
        let bukuId = this.dataset.id;

        form.setAttribute('action', `/admin/buku/update/${bukuId}`);

        
        document.getElementById('editBukuId').value = bukuId;
        document.getElementById('editJudul').value = this.dataset.judul;
        document.getElementById('editPenulis').value = this.dataset.penulis;
        document.getElementById('editPenerbit').value = this.dataset.penerbit;
        document.getElementById('editTahunTerbit').value = this.dataset.tahun_terbit;
        document.getElementById('editStok').value = this.dataset.stok;
        document.getElementById('editKategoriID').value = this.dataset.kategori_id;

     
        let coverPreview = document.getElementById('coverPreview');
        if (coverPreview) {
            coverPreview.src = this.dataset.cover;
        }
    });
});
</script>
</body>
</html>
