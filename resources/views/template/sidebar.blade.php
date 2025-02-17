<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        @if(Auth::check())
            @if(Auth::user()->role == 'administrator')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard Admin</span>
                    </a>
                </li>

                <!-- Dropdown Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-toggle="collapse" href="#menuDropdown" aria-expanded="false">
                        <i class="bi bi-list"></i>
                        <span>Menu</span>
                        <i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="menuDropdown" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="{{ route('admin.data.admin') }}">
                                <i class="bi bi-person-badge"></i>
                                <span>Data Admin</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.data.petugas') }}">
                                <i class="bi bi-person-check"></i>
                                <span>Data Petugas</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.data.peminjam') }}">
                                <i class="bi bi-people"></i>
                                <span>Data Peminjam</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.data.buku') }}">
                                <i class="bi bi-book"></i>
                                <span>Data Buku</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ route('admin.kategori.index') }}">
                        <i class="bi bi-tags"></i>
                        <span>Kategori Buku</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ route('admin.data.peminjaman') }}">
                        <i class="bi bi-arrow-down-circle"></i>
                        <span>Data Peminjaman</span>
                    </a>
                </li>

            @elseif(Auth::user()->role == 'petugas')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('petugas.dashboard') }}">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard Petugas</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ route('admin.data.peminjaman') }}">
                        <i class="bi bi-arrow-down-circle"></i>
                        <span>Data Peminjaman</span>
                    </a>
                </li>

            @elseif(Auth::user()->role == 'peminjam')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('peminjam.dashboard') }}">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard Peminjam</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ route('admin.data.buku') }}">
                        <i class="bi bi-book"></i>
                        <span>Daftar Buku</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ route('admin.data.peminjaman') }}">
                        <i class="bi bi-arrow-up-circle"></i>
                        <span>Peminjaman Saya</span>
                    </a>
                </li>
            @endif
        @endif
    </ul>
</aside>
@include('template.script')