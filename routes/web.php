<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\PeminjamController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\KategoriBukuController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile');
    Route::get('/profile/edit', [AuthController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


Route::middleware(['auth', 'role:administrator'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    Route::get('/data-admin', [UserController::class, 'indexAdmin'])->name('data.admin');
    Route::post('/data-admin/store', [UserController::class, 'store'])->name('data.admin.store');
    Route::put('/data-admin/update/{id}', [UserController::class, 'update'])->name('data.admin.update');
    Route::delete('/data-admin/destroy/{id}', [UserController::class, 'destroy'])->name('data.admin.destroy');

    Route::get('/data-petugas', [UserController::class, 'indexPetugas'])->name('data.petugas');
    Route::post('/data-petugas/store', [UserController::class, 'store'])->name('data.petugas.store');
    Route::put('/data-petugas/update/{id}', [UserController::class, 'update'])->name('data.petugas.update');
    Route::delete('/data-petugas/destroy/{id}', [UserController::class, 'destroy'])->name('data.petugas.destroy');

    
    Route::get('/data-peminjam', [UserController::class, 'indexPeminjam'])->name('data.peminjam');
    Route::post('/data-peminjam/store', [UserController::class, 'store'])->name('data.peminjam.store');
    Route::put('/data-peminjam/update/{id}', [UserController::class, 'update'])->name('data.peminjam.update');
    Route::delete('/data-peminjam/destroy/{id}', [UserController::class, 'destroy'])->name('data.peminjam.destroy');

   
    Route::get('/data-peminjaman', [PeminjamanController::class, 'index'])->name('data.peminjaman');

 
    Route::get('/buku', [BukuController::class, 'index'])->name('data.buku');
    Route::post('/buku/store', [BukuController::class, 'store'])->name('buku.store');
    Route::put('/buku/update/{BukuID}', [BukuController::class, 'update'])->name('buku.update');
    Route::delete('/buku/destroy/{BukuID}', [BukuController::class, 'destroy'])->name('buku.destroy');

    
    Route::get('/kategori-buku', [KategoriBukuController::class, 'index'])->name('kategori.index');
    Route::post('/kategori-buku/store', [KategoriBukuController::class, 'store'])->name('kategori.store');
    Route::post('/kategori-buku/update/{KategoriID}', [KategoriBukuController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori-buku/destroy/{KategoriID}', [KategoriBukuController::class, 'destroy'])->name('kategori.destroy');


    Route::get('/data-peminjaman', [PeminjamanController::class, 'index'])->name('data.peminjaman');
Route::get('/data-peminjaman/create', [PeminjamanController::class, 'create'])->name('data.peminjaman.create');
Route::post('/data-peminjaman/store', [PeminjamanController::class, 'store'])->name('data.peminjaman.store');
Route::put('/data-peminjaman/update/{id}', [PeminjamanController::class, 'update'])->name('data.peminjaman.update');
Route::delete('/data-peminjaman/destroy/{id}', [PeminjamanController::class, 'destroy'])->name('data.peminjaman.destroy');

});


Route::middleware(['auth', 'role:petugas'])->prefix('petugas')->name('petugas.')->group(function () {
    Route::get('/dashboard', [PetugasController::class, 'index'])->name('dashboard');
});


Route::middleware(['auth', 'role:peminjam'])->prefix('peminjam')->name('peminjam.')->group(function () {
    Route::get('/dashboard', [PeminjamController::class, 'index'])->name('dashboard');
});
