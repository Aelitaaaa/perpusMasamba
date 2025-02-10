<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\PeminjamController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;


    Route::get('/index', function () {
        return view('index');
    })->name('dashboard');

    
    Route::middleware(['auth'])->group(function () {
       
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::get('/profile/edit', [AuthController::class, 'editProfile'])->name('profile.edit');
        Route::put('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');

        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    });

    Route::middleware('guest')->group(function () {
        Route::get('/login', function () {
            return view('auth.login');
        })->name('login');

        Route::post('/login', [LoginController::class, 'login']);

        Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
        Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
    });

    
    Route::middleware(['auth', 'role:administrator'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

     
        Route::get('/admin/data/admin', [AdminController::class, 'dataAdmin'])->name('admin.data.admin');
        Route::get('/admin/data/petugas', [AdminController::class, 'dataPetugas'])->name('admin.data.petugas');
        Route::get('/admin/data/peminjam', [AdminController::class, 'dataPeminjam'])->name('admin.data.peminjam');
        Route::get('/admin/kategori-buku', [BukuController::class, 'kategori'])->name('admin.kategori.buku');
        Route::get('/admin/data-peminjaman', [PeminjamanController::class, 'index'])->name('admin.data.peminjaman');

     
        Route::get('/admin/data-buku', [BukuController::class, 'index'])->name('admin.data.buku');
        Route::post('/admin/buku/store', [BukuController::class, 'store'])->name('admin.buku.store');
        Route::get('/admin/buku/edit/{id}', [BukuController::class, 'edit'])->name('admin.buku.edit');
        Route::put('/admin/buku/update/{id}', [BukuController::class, 'update'])->name('admin.buku.update');
        Route::delete('/admin/buku/destroy/{id}', [BukuController::class, 'destroy'])->name('admin.buku.destroy');
    });

    Route::middleware(['auth', 'role:petugas'])->group(function () {
        Route::get('/petugas/dashboard', [PetugasController::class, 'index'])->name('petugas.dashboard');
    });

    Route::middleware(['auth', 'role:peminjam'])->group(function () {
        Route::get('/peminjam/dashboard', [PeminjamController::class, 'index'])->name('peminjam.dashboard');
    });

