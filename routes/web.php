<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\DashboardPengunjungController;
use App\Http\Controllers\DashboardPengelolaController;
use App\Http\Controllers\CheckinController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\KegiatanController;
/*
|--------------------------------------------------------------------------
| LANDING PAGE
|--------------------------------------------------------------------------
*/

Route::get('/', [DashboardPengunjungController::class, 'index'])
    ->name('home');

Route::get('/dashboard', [DashboardPengunjungController::class, 'index'])
    ->name('dashboard.pengunjung');


/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| DASHBOARD PENGELOLA
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/dashboard-pengelola', [DashboardPengelolaController::class, 'index'])
        ->name('dashboard.pengelola');
});


/*
|--------------------------------------------------------------------------
| FITUR PENGUNJUNG
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/pesan-tempat', [PemesananController::class, 'create'])
        ->name('pesan.tempat');

    Route::post('/pesan-tempat', [PemesananController::class, 'store'])
        ->name('pesan.tempat.store');

    Route::get('/riwayat-pemesanan', [PemesananController::class, 'index'])
        ->name('riwayat.pemesanan');
});


/*
|--------------------------------------------------------------------------
| PEMBAYARAN
|--------------------------------------------------------------------------
*/

Route::get('/pembayaran/{id}', [PembayaranController::class, 'proses'])
    ->name('pembayaran.proses');

Route::get('/pembayaran/berhasil/{id}', [PembayaranController::class, 'berhasil'])
    ->name('pembayaran.berhasil');


/*
|--------------------------------------------------------------------------
| ADMIN AREA
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/admin/pemesanan', [PemesananController::class, 'adminIndex'])
        ->name('admin.pemesanan');

    Route::get('/admin/jadwal', [PemesananController::class, 'jadwal'])
        ->name('admin.jadwal');

    Route::get('/admin/pembayaran', [PemesananController::class, 'pembayaran'])
        ->name('admin.pembayaran');

    Route::get('/admin/generate-tiket/{id}', [PemesananController::class, 'generateTiket'])
        ->name('admin.generate.tiket');
});


/*
|--------------------------------------------------------------------------
| CHECK-IN QR SCANNER
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/admin/checkin', [PemesananController::class, 'formCheckin'])
        ->name('admin.checkin.form');

    Route::post('/admin/checkin/proses', [CheckinController::class, 'proses'])
        ->name('admin.checkin.proses');
});


/*
|--------------------------------------------------------------------------
| E-TICKET
|--------------------------------------------------------------------------
*/

Route::get('/tiket/{id}', function ($id) {

    $pemesanan = \App\Models\Pemesanan::findOrFail($id);

    return view('pengunjung.eticket', compact('pemesanan'));
})->name('pengunjung.eticket');
Route::get('/e-ticket', [PemesananController::class, 'eticketUser'])
    ->name('pengunjung.eticket.user');


Route::middleware('auth')->group(function () {

    Route::get('/admin/fasilitas', [FasilitasController::class, 'index'])
        ->name('admin.fasilitas');

    Route::post('/admin/fasilitas/store', [FasilitasController::class, 'store'])
        ->name('admin.fasilitas.store');

    Route::post('/admin/fasilitas/update/{id}', [FasilitasController::class, 'update'])
        ->name('admin.fasilitas.update');

    Route::get('/admin/fasilitas/delete/{id}', [FasilitasController::class, 'destroy'])
        ->name('admin.fasilitas.delete');
});



Route::middleware('auth')->group(function () {

    Route::get('/review', [ReviewController::class, 'index'])
        ->name('pengunjung.review');
});

Route::prefix('admin')->group(function () {

    Route::get('/kegiatan', [KegiatanController::class, 'index'])->name('admin.kegiatan');
    Route::get('/kegiatan/create', [KegiatanController::class, 'create'])->name('admin.kegiatan.create');
    Route::post('/kegiatan/store', [KegiatanController::class, 'store'])->name('admin.kegiatan.store');
    Route::get('/kegiatan/edit/{id}', [KegiatanController::class, 'edit'])->name('admin.kegiatan.edit');
    Route::put('/kegiatan/update/{id}', [KegiatanController::class, 'update'])->name('admin.kegiatan.update');
    Route::delete('/kegiatan/delete/{id}', [KegiatanController::class, 'destroy'])->name('admin.kegiatan.delete');
});
