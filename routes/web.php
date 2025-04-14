<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

use App\Http\Controllers\KasirPelangganController;

Route::get('kasir_pelanggans', [KasirPelangganController::class, 'index'])->name('kasir_pelanggans.index');
Route::get('kasir_pelanggans/create', [KasirPelangganController::class, 'create'])->name('kasir_pelanggans.create');
Route::post('kasir_pelanggans', [KasirPelangganController::class, 'store'])->name('kasir_pelanggans.store');
Route::get('kasir_pelanggans/{id}/edit', [KasirPelangganController::class, 'edit'])->name('kasir_pelanggans.edit');
Route::put('kasir_pelanggans/{id}', [KasirPelangganController::class, 'update'])->name('kasir_pelanggans.update');
Route::delete('kasir_pelanggans/{id}', [KasirPelangganController::class, 'destroy'])->name('kasir_pelanggans.destroy');
Route::get('/kasir_pelanggan/search', [KasirPelangganController::class, 'search'])->name('kasir_pelanggan.search');

use App\Http\Controllers\KasirProdukController;

Route::get('kasir_produks', [KasirProdukController::class, 'index'])->name('kasir_produks.index');
Route::get('kasir_produks/create', [KasirProdukController::class, 'create'])->name('kasir_produks.create');
Route::post('kasir_produks', [KasirProdukController::class, 'store'])->name('kasir_produks.store');
Route::get('kasir_produks/{id}/edit', [KasirProdukController::class, 'edit'])->name('kasir_produks.edit');
Route::put('/kasir_produks/{ProdukID}', [KasirProdukController::class, 'update'])->name('kasir_produks.update');
Route::delete('kasir_produks/{id}', [KasirProdukController::class, 'destroy'])->name('kasir_produks.destroy');
Route::get('/kasir_produk/search', [KasirProdukController::class, 'search'])->name('kasir_produk.search');
Route::post('/produk/restok', [KasirProdukController::class, 'restok'])->name('kasir_produk.restok');


use App\Http\Controllers\KasirPenjualanController;

Route::get('kasir_penjualans', [KasirPenjualanController::class, 'index'])->name('kasir_penjualans.index');
Route::get('/kasir_penjualans/create', [KasirPenjualanController::class, 'create'])->name('kasir_penjualans.create');
Route::post('kasir_penjualans', [KasirPenjualanController::class, 'store'])->name('kasir_penjualans.store');
Route::get('kasir_penjualans/{id}/edit', [KasirPenjualanController::class, 'edit'])->name('kasir_penjualans.edit');
Route::put('kasir_penjualans/{id}', [KasirPenjualanController::class, 'update'])->name('kasir_penjualans.update');
Route::delete('kasir_penjualans/{id}', [KasirPenjualanController::class, 'destroy'])->name('kasir_penjualans.destroy');
Route::get('/kasir_penjualan/search', [KasirPenjualanController::class, 'search'])->name('kasir_penjualan.search');
Route::get('/kasir_penjualan/{id}', [KasirPenjualanController::class, 'show'])->name('kasir_penjualan.show');


use App\Http\Controllers\DetailPenjualanController;

Route::get('detail_penjualans', [DetailPenjualanController::class, 'index'])->name('detail_penjualans.index');
Route::get('detail_penjualans/create', [DetailPenjualanController::class, 'create'])->name('detail_penjualans.create');
Route::post('detail_penjualans', [DetailPenjualanController::class, 'store'])->name('detail_penjualans.store');
Route::get('detail_penjualans/{id}/edit', [DetailPenjualanController::class, 'edit'])->name('detail_penjualans.edit');
Route::put('detail_penjualans/{id}', [DetailPenjualanController::class, 'update'])->name('detail_penjualans.update');
Route::delete('detail_penjualans/{id}', [DetailPenjualanController::class, 'destroy'])->name('detail_penjualans.destroy');
Route::get('/detail_penjualan/search', [DetailPenjualanController::class, 'search'])->name('detail_penjualan.search');
Route::get('detail_penjualans/{id}', [DetailPenjualanController::class, 'show'])->name('detail_penjualans.show');

use App\Http\Controllers\KategoriController;

Route::get('kategoris', [KategoriController::class, 'index'])->name('kategoris.index');
Route::get('kategoris/create', [KategoriController::class, 'create'])->name('kategoris.create');
Route::post('kategoris', [KategoriController::class, 'store'])->name('kategoris.store');
Route::get('kategoris/{id}/edit', [KategoriController::class, 'edit'])->name('kategoris.edit');
Route::put('kategoris/{id}', [KategoriController::class, 'update'])->name('kategoris.update');
Route::delete('kategoris/{id}', [KategoriController::class, 'destroy'])->name('kategoris.destroy');
Route::get('/kategori/search', [KategoriController::class, 'search'])->name('kategori.search');

use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

use App\Http\Controllers\PenjualanController;

Route::get('/penjualan/create/{id}', [PenjualanController::class, 'create'])->name('penjualan.create');


use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;

// Route untuk login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Middleware untuk admin

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('kasir_produk', KasirProdukController::class);
    
});
Route::middleware(['auth', 'role:kasir'])->group(function () {
    Route::get('/kasir/dashboard', [KasirController::class, 'index'])->name('kasir.dashboard');
    
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

use App\Http\Controllers\Auth\RegisteredUserController;

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin-dashboard', function () {
        return "Halo Admin";
    });
});

Route::middleware(['auth', 'role:kasir'])->group(function () {
    Route::get('/kasir-dashboard', function () {
        return "Halo Kasir";
    });
});

Route::middleware(['auth'])->group(function () {
    Route::resource('kategoris', KategoriController::class);
    Route::resource('kasir_produks', KasirProdukController::class);
    Route::resource('kasir_pelanggans', KasirPelangganController::class);
    Route::resource('kasir_penjualans', KasirPenjualanController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

use App\Http\Controllers\LaporanController;

Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
Route::post('/laporan/cetak', [LaporanController::class, 'cetak'])->name('laporan.cetak'); // Ubah GET menjadi POST



