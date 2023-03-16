<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MasyarakatController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TanggapanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PengaduanPublicController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [MasyarakatController::class, 'login'])->name('login');
Route::post('login', [MasyarakatController::class, 'auth']);
Route::post('logout', [MasyarakatController::class, 'logout']);

Route::resource('pengaduan', PengaduanController::class);

Route::get('register', [MasyarakatController::class, 'register']);
Route::post('register', [MasyarakatController::class, 'store']);

Route::get('daftar-pengaduan', [PengaduanPublicController::class, 'index']);

Route::get('admin', [PetugasController::class, 'loginAdmin']);
Route::post('admin', [PetugasController::class, 'authAdmin']);
Route::post('/admin/logoutAdmin', [PetugasController::class, 'logoutAdmin']);

Route::prefix('admin')->group(function() {
    Route::middleware(['isAdmin'])->group(function() {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::get('masyarakat', [MasyarakatController::class, 'index']);

        Route::get('petugas', [PetugasController::class, 'index'])->name('petugas.index');
        Route::post('petugas', [PetugasController::class, 'store'])->name('petugas.store');
        Route::delete('petugas/{id}', [PetugasController::class, 'destroy'])->name('petugas.destroy');

        Route::get('tanggapan', [TanggapanController::class, 'index'])->name('tanggapan.index');
        Route::get('tanggapan/cari', [TanggapanController::class, 'cari']);
        Route::post('tanggapan/createOrUpdate', [TanggapanController::class, 'createOrUpdate'])->name('tanggapan.createOrUpdate');
        Route::get('tanggapan/{id}', [PengaduanController::class, 'kirimTanggapan'])->name('pengaduan.kirimTanggapan');

        Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::post('getLaporan', [LaporanController::class, 'getLaporan'])->name('laporan.getLaporan');
        Route::get('laporan/cetak/{from}/{to}', [LaporanController::class, 'cetakLaporan'])->name('laporan.cetakLaporan');
    });

    Route::middleware(['isPetugas'])->group(function() {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::get('masyarakat', [MasyarakatController::class, 'index']);

        Route::get('tanggapan', [TanggapanController::class, 'index'])->name('tanggapan.index');
        Route::post('tanggapan/createOrUpdate', [TanggapanController::class, 'createOrUpdate'])->name('tanggapan.createOrUpdate');
        Route::get('tanggapan/{id}', [PengaduanController::class, 'kirimTanggapan'])->name('pengaduan.kirimTanggapan');
    });
});


