<!DOCTYPE html>
<html lang="id">

<head>
    @include('template.head')
    <style>
        .table th, .table td {
            vertical-align: middle;
            text-align: center;
        }
    </style>
</head>

<body>
    @include('template.header')
    @include('template.sidebar')

    <main id="main" class="main" style="padding-top: 80px;">
        <div class="pagetitle">
            <h1>Data Peminjaman</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Data Peminjaman</li>
                </ol>
            </nav>
        </div>

        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Daftar Peminjaman Buku</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Nama Peminjam</th>
                            <th>Judul Buku</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Tanggal Pengembalian</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($peminjaman as $index => $pinjam)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $pinjam->user->namalengkap }}</td>
                            <td>{{ $pinjam->buku->judul }}</td>
                            <td>{{ $pinjam->TanggalPeminjaman }}</td>
                            <td>{{ $pinjam->TanggalPengembalian ?? '-' }}</td>
                            <td>
                                @if($pinjam->StatusPeminjaman == 'dipinjam')
                                    <span class="badge bg-warning">Dipinjam</span>
                                @elseif($pinjam->StatusPeminjaman == 'dikembalikan')
                                    <span class="badge bg-success">Dikembalikan</span>
                                @else
                                    <span class="badge bg-secondary">Tidak Diketahui</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('peminjaman.edit', $pinjam->PeminjamanID) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('peminjaman.destroy', $pinjam->PeminjamanID) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    @include('template.footer')
    @include('template.script')
</body>

</html>
