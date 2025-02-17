<!DOCTYPE html>
<html lang="id">
<head>
    @include('template.head')
</head>
<body>
    @include('template.header')
    @include('template.sidebar')

    <main id="main" class="main">
        <div class="pagetitle d-flex justify-content-between align-items-center">
            <h1>Data Kategori Buku</h1>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahKategoriModal">Tambah Kategori</button>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kategori as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->NamaKategori }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm editKategoriBtn"
                            data-id="{{ $item->KategoriID }}"
                            data-nama="{{ $item->NamaKategori }}"
                            data-bs-toggle="modal"
                            data-bs-target="#editKategoriModal">
                            Edit
                        </button>

                        <form action="{{ route('admin.kategori.destroy', $item->KategoriID) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus kategori ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </main>

    <!-- Modal Tambah Kategori -->
    <div class="modal fade" id="tambahKategoriModal">
        <div class="modal-dialog">
            <form action="{{ route('admin.kategori.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <label for="NamaKategori">Nama Kategori</label>
                        <input type="text" name="NamaKategori" class="form-control" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Kategori -->
    <div class="modal fade" id="editKategoriModal">
        <div class="modal-dialog">
            <form id="editKategoriForm" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <label for="editNamaKategori">Nama Kategori</label>
                        <input type="text" name="NamaKategori" id="editNamaKategori" class="form-control" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-warning">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @include('template.script')

    <script>
        document.querySelectorAll('.editKategoriBtn').forEach(button => {
            button.addEventListener('click', function() {
                document.getElementById('editNamaKategori').value = this.dataset.nama;
                document.getElementById('editKategoriForm').action = `{{ url('/admin/kategori/update') }}/${this.dataset.id}`;
            });
        });
    </script>

</body>
</html>
