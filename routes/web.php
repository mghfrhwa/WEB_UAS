<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProgresController;
use App\Http\Controllers\BahanController;
use App\Http\Controllers\PemakaianBahanController;
use App\Http\Controllers\PesananPenggunaController;
use App\Http\Controllers\LaporanKeuanganController;
use App\Http\Controllers\AdminDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Redirect halaman utama ('/') langsung ke halaman login
Route::get('/', function () {
    return view('welcome');
});

// ====================================================
// AUTHENTICATION ROUTES
// ====================================================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


// ====================================================
// CUSTOMER AREA
// ====================================================
Route::middleware(['auth', 'role:customer'])->prefix('customer')->group(function () {
    Route::get('/dashboard', [PesananPenggunaController::class, 'dashboard'])->name('customer.dashboard');
    Route::get('/katalog', [KatalogController::class, 'publicIndex'])->name('customer.katalog');

    Route::get('/cek-kode', function () {
        return view('customer.cek-kode');
    })->name('customer.cekKodeForm');

    Route::post('/cek-kode', [PesananPenggunaController::class, 'cekKode'])->name('customer.cekKode');
    Route::get('/pesanan/{kode}', [PesananPenggunaController::class, 'show'])->name('customer.pesanan.show');
});


// ====================================================
// ADMIN AREA
// ====================================================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {

    // Ganti closure function dengan pemanggilan Controller
    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // --- Manajemen Pesanan ---
    Route::get('/pesanan/riwayat', [PesananController::class, 'riwayat'])->name('pesanan.riwayat');
    Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index');
    Route::get('/pesanan/tambah', [PesananController::class, 'create'])->name('pesanan.create');
    Route::post('/pesanan/store', [PesananController::class, 'store'])->name('pesanan.store');
    Route::get('/pesanan/{id}', [PesananController::class, 'show'])->name('pesanan.show');
    Route::get('/pesanan/{id}/edit', [PesananController::class, 'edit'])->name('pesanan.edit');
    Route::put('/pesanan/{id}', [PesananController::class, 'update'])->name('pesanan.update');
    Route::delete('/pesanan/{id}', [PesananController::class, 'destroy'])->name('pesanan.destroy');

    // --- Laporan Keuangan ---
    Route::get('/laporan-keuangan', [LaporanKeuanganController::class, 'index'])
        ->name('laporan.keuangan');
    Route::put('/pesanan/{id}/pembayaran', [LaporanKeuanganController::class, 'updatePembayaran'])
        ->name('pesanan.updatePembayaran');

    // --- Manajemen Progres (DIPERBAIKI) ---
    Route::get('/progres', [ProgresController::class, 'index'])->name('progres.index');
    
    // LIST: Perbaikan nama route menjadi 'progres.listByPesanan' (agar sesuai controller)
    Route::get('/pesanan/{pesanan_id}/progres', [ProgresController::class, 'listByPesanan'])
        ->name('progres.listByPesanan');

    // CREATE: Route create dengan parameter pesanan_id
    Route::get('/pesanan/{pesanan_id}/progres/create', [ProgresController::class, 'create'])
        ->name('progres.create');
        
    // CRUD Actions (Store, Edit, Update, Destroy)
    Route::post('/progres', [ProgresController::class, 'store'])->name('progres.store');
    Route::get('/progres/{id}/edit', [ProgresController::class, 'edit'])->name('progres.edit');
    Route::put('/progres/{id}', [ProgresController::class, 'update'])->name('progres.update');
    Route::delete('/progres/{id}', [ProgresController::class, 'destroy'])->name('progres.destroy');

    // --- Manajemen Bahan ---
    Route::get('/bahan', [BahanController::class, 'index'])->name('bahan.index');
    Route::get('/bahan/create', [BahanController::class, 'create'])->name('bahan.create');
    Route::post('/bahan/store', [BahanController::class, 'store'])->name('bahan.store');
    Route::get('/bahan/{id}/edit', [BahanController::class, 'edit'])->name('bahan.edit');
    Route::put('/bahan/{id}', [BahanController::class, 'update'])->name('bahan.update');
    Route::delete('/bahan/{id}', [BahanController::class, 'destroy'])->name('bahan.destroy');

    // Pemakaian Bahan
    Route::post('/pemakaian-bahan', [PemakaianBahanController::class, 'store'])->name('pemakaian.store');

    // --- Manajemen Katalog ---
    Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog.index');
    Route::post('/katalog/store', [KatalogController::class, 'store'])->name('katalog.store');
    Route::put('/katalog/{id}', [KatalogController::class, 'update'])->name('katalog.update');
    Route::delete('/katalog/{id}', [KatalogController::class, 'destroy'])->name('katalog.destroy');

});