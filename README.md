
<p align="center">
  <img src="https://img.icons8.com/ios-filled/500/000000/library.png" width="150">
</p>

<h1 align="center">Sistem Manajemen Perpustakaan</h1>

<p align="center">
  Backend aplikasi perpustakaan berbasis Laravel 8 dengan fitur lengkap seperti manajemen buku, peminjaman, pengembalian, ulasan buku, dan banyak lagi.
</p>

<p align="center">
  <a href="#"><img src="https://img.shields.io/badge/build-passing-brightgreen.svg" alt="Build Status"></a>
  <a href="#"><img src="https://img.shields.io/badge/laravel-8.x-red.svg" alt="Laravel Version"></a>
  <a href="#"><img src="https://img.shields.io/badge/license-MIT-blue.svg" alt="License"></a>
</p>

---

## 📘 Tentang Aplikasi

Sistem ini memudahkan pengelolaan buku, pengguna, dan transaksi peminjaman/pengembalian buku. Role pengguna dibagi menjadi:
- **Admin** – Mengelola pengguna & data master
- **Petugas** – Mengelola buku & peminjaman
- **Peminjam** – Melihat dan meminjam buku

---

## 🚀 Fitur Utama

- 📚 CRUD Buku & Kategori
- 👥 Manajemen Pengguna (Admin, Petugas, Peminjam)
- 🔄 Proses Peminjaman & Pengembalian
- 📝 Riwayat Peminjaman
- 🌟 Ulasan Buku
- 📌 Koleksi Buku Incaran
- 📊 Dashboard Statistik

---

## 🧰 Teknologi

- **Backend**: Laravel 8
- **Database**: MySQL
- **Frontend**: Blade + Bootstrap
- **ORM**: Eloquent
- **Auth**: Laravel Auth

---

## 📦 Instalasi

git clone https://github.com/dzakyputra/perpustakaan-app.git
cd perpustakaan-app
composer install
cp .env.example .env
php artisan key:generate

 ## 🛡️ Hak Akses
Middleware disesuaikan untuk membatasi akses berdasarkan role
Akses dashboard dan fitur hanya sesuai hak masing-masing user


👤 Kontributor
https://github.com/Aelitaaaa
