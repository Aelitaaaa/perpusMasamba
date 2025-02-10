<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

        <!-- Dashboard (Tampil untuk semua) -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        @if(Auth::check())
            <!-- Menu Data (Dropdown) -->
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-toggle="collapse" href="#dataMenu" aria-expanded="false">
                    <i class="bi bi-folder"></i>
                    <span>Data</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="dataMenu" class="collapse list-unstyled">
                    <li><a href="{{ route('admin.data.admin') }}">Data Admin</a></li>
                    <li><a href="{{ route('admin.data.petugas') }}">Data Petugas</a></li>
                    <li><a href="{{ route('admin.data.peminjam') }}">Data Peminjam</a></li>
                    <li><a href="{{ route('admin.data.buku') }}">Data Buku</a></li>
                </ul>
            </li>

            <!-- Kategori Buku -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('admin.kategori.buku') }}">
                    <i class="bi bi-tags"></i>
                    <span>Kategori Buku</span>
                </a>
            </li>

            <!-- Data Peminjaman -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('admin.data.peminjaman') }}">
                    <i class="bi bi-arrow-down-circle"></i>
                    <span>Data Peminjaman</span>
                </a>
            </li>
        @endif
    </ul>
</aside>
