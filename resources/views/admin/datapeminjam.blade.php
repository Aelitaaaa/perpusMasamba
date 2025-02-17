<!DOCTYPE html>
<html lang="id">
<head>
    @include('template.head')
</head>
<body>
    @include('template.header')
    @include('template.sidebar')

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Data Peminjam</h1>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->namalengkap }}</td>
                    <td>{{ $user->Email }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm">Edit</button>
                        <form action="{{ route('admin.data.peminjam.destroy', $user->UserID) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </main>

    @include('template.script')
</body>
</html>
