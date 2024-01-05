<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ApotekController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RekamController;
use App\Http\Controllers\DashboardController;

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
// -------------------------------------------------------- Login------------------------------------------------------------------------------
Route::get('/', [HomeController::class, 'index']);
Route::get('/pasien/antrian-pasien', [PasienController::class, 'antrianpasien']);
// Route::get('/pasien/pasien-rekammedis', [PasienController::class, 'edit']);
Route::post('/pasien/cekpasienlama', [PasienController::class, 'cekpasienlama']);
Route::get('/pasien/pasien-lama', [PasienController::class, 'pasienlama']);
Route::post('/pasien/store', [PasienController::class, 'store']);
Route::post('/addrekam', [RekamController::class, 'store']);

//  jika user belum login
Route::group(['middleware' => 'guest'], function() {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'dologin']);

});

// untuk superadmin dan pegawai
Route::group(['middleware' => ['auth', 'checkrole:1,2,3']], function() {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/redirect', [RedirectController::class, 'cek']);
});


// untuk superadmin
Route::group(['middleware' => ['auth', 'checkrole:1']], function() {
    Route::get('/superadmin', [SuperAdminController::class, 'index']);
});

// untuk pegawai
Route::group(['middleware' => ['auth', 'checkrole:2']], function() {
    Route::get('/admin', [AdminController::class, 'index']);

});
// untuk pegawai
Route::group(['middleware' => ['auth', 'checkrole:3']], function() {
    Route::get('/apotek', [ApotekController::class, 'index']);

});

// --------------------------------------------------------User------------------------------------------------------------------------------
    
Route::get('user_page/index', [UserController::class, 'index'])->name('users')->middleware('auth','checkrole:1,2');

Route::get('user_page/show/{user:id}', [UserController::class, 'show'])->name('users')->middleware('auth','checkrole:1,2');

Route::post('user_page/index', [UserController::class, 'store'])->middleware('auth','checkrole:1,2');

Route::get('user_page/create', [UserController::class, 'create'])->middleware('auth','checkrole:1,2');

Route::get('user_page/edit/{id}', [UserController::class, 'edit'])->middleware('auth','checkrole:1');

Route::post('user_page/update/{id}', [UserController::class, 'update'])->middleware('auth','checkrole:1');

Route::get('user_page/delete/{id}', [UserController::class, 'destroy'])->middleware('auth','checkrole:1');

// --------------------------------------------------------Obat------------------------------------------------------------------------------

Route::get('obat_page/total_stok', [ObatController::class, 'index'])->name('users')->middleware('auth','checkrole:1,2,3');

Route::get('obat_page/total_stok/cari', [ObatController::class, 'cari'])->name('users')->middleware('auth','checkrole:1,2,3');

Route::get('obat_page/obat_form', [ObatController::class, 'form'])->name('users')->middleware('auth','checkrole:1,2,3');

Route::post('obat_page/total_stok', [ObatController::class, 'store'])->middleware('auth','checkrole:1,2,3');

Route::get('obat_page/edit/{id}', [ObatController::class, 'edit'])->name('users')->middleware('auth','checkrole:1,2,3');

Route::post('obat_page/update/{id}', [ObatController::class, 'update'])->middleware('auth','checkrole:1,2,3');

Route::get('obat_page/delete/{id}', [ObatController::class, 'destroy'])->name('users')->middleware('auth','checkrole:1,2,3');

// --------------------------------------------------------JenisObat--------------------------------------------------------------------------

Route::get('jenis_obat/index', [JenisController::class, 'index'])->name('users')->middleware('auth','checkrole:1,2,3');

Route::post('jenis_obat/index', [JenisController::class, 'store'])->name('users')->middleware('auth','checkrole:1,2,3');

Route::get('jenis_obat/create', [JenisController::class, 'create'])->name('users')->middleware('auth','checkrole:1,2,3');

Route::get('jenis_obat/delete/{id}', [JenisController::class, 'destroy'])->middleware('auth','checkrole:1,2,3');

// --------------------------------------------------------Dokter------------------------------------------------------------------------------

Route::get('dokter_page/index', [DokterController::class, 'index'])->name('users')->middleware('auth','checkrole:1,2');

Route::post('dokter_page/index', [DokterController::class, 'store'])->name('users')->middleware('auth','checkrole:1,2');

Route::get('dokter_page/create', [DokterController::class, 'create'])->name('users')->middleware('auth','checkrole:1,2');

Route::post('dokter_page/update/{id}', [DokterController::class, 'update'])->name('users')->middleware('auth','checkrole:1,2');

Route::get('dokter_page/edit/{id}', [DokterController::class, 'edit'])->name('users')->middleware('auth','checkrole:1,2');

Route::get('dokter_page/delete/{id}', [DokterController::class, 'destroy'])->name('users')->middleware('auth','checkrole:1,2');

// --------------------------------------------------------Jadwal------------------------------------------------------------------------------

Route::get('jadwal/index', [JadwalController::class, 'index'])->name('users')->middleware('auth','checkrole:1,2');

Route::post('jadwal/index', [JadwalController::class, 'store'])->name('users')->middleware('auth','checkrole:1,2');

Route::get('jadwal/create', [JadwalController::class, 'create'])->name('users')->middleware('auth','checkrole:1,2');

Route::get('jadwal/delete/{id}', [JadwalController::class, 'destroy'])->middleware('auth','checkrole:1,2');

// --------------------------------------------------------Poli------------------------------------------------------------------------------

Route::get('poli/index', [PoliController::class, 'index'])->name('users')->middleware('auth','checkrole:1,2');

Route::post('poli/index', [PoliController::class, 'store'])->name('users')->middleware('auth','checkrole:1,2');

Route::get('poli/create', [PoliController::class, 'create'])->name('users')->middleware('auth','checkrole:1,2');

Route::get('poli/edit/{id}', [PoliController::class, 'edit'])->name('users')->middleware('auth','checkrole:1,2');

Route::post('poli/update/{id}', [PoliController::class, 'update'])->name('users')->middleware('auth','checkrole:1,2');

Route::get('poli/delete/{id}', [PoliController::class, 'destroy'])->name('users')->middleware('auth','checkrole:1,2');

// --------------------------------------------------------Pasien------------------------------------------------------------------------------

Route::get('pasien/index', [PasienController::class, 'index'])->name('users')->middleware('auth','checkrole:1,2');

Route::post('pasien/index', [PasienController::class, 'store'])->name('users')->middleware('auth','checkrole:1,2');

Route::post('update-pasien', [PasienController::class, 'updatepasien'])->name('users')->middleware('auth','checkrole:1,2');

Route::get('pasien/tambahpasienform', [PasienController::class, 'create'])->name('users')->middleware('auth','checkrole:1,2');

Route::get('pasien/pasien-rekammedis/edit/{id}', [PasienController::class, 'edit'])->name('users')->middleware('auth','checkrole:1,2');

Route::post('pasien/update/{id}', [PasienController::class, 'update'])->name('users')->middleware('auth','checkrole:1,2');

Route::get('pasien/delete/{id}', [PasienController::class, 'destroy'])->name('users')->middleware('auth','checkrole:1,2');

Route::post('pasien/cekpasienlama', [PasienController::class, 'cekpasienlama'])->name('users')->middleware('auth','checkrole:1,2');

// --------------------------------------------------------Dashboard------------------------------------------------------------------------------

Route::get('dashboard/pendaftaran', [DashboardController::class, 'pendaftaran'])->name('users')->middleware('auth','checkrole:1,2');

Route::post('cekpasienlamaadmin', [DashboardController::class, 'cekpasienlama'])->name('users')->middleware('auth','checkrole:1,2');

Route::post('addrekamadmin', [DashboardController::class, 'addrekam'])->name('users')->middleware('auth','checkrole:1,2');

Route::post('tambahpasien', [DashboardController::class, 'tambahpasien'])->name('users')->middleware('auth','checkrole:1,2');

Route::get('tambahpasienadmin', [DashboardController::class, 'tambahpasienform'])->name('users')->middleware('auth','checkrole:1,2');

// --------------------------------------------------------Rekam------------------------------------------------------------------------------

Route::get('rekam/antrian-pasien-admin', [RekamController::class, 'antrianpasien'])->name('users')->middleware('auth','checkrole:1,2');

Route::post('rekam-store', [RekamController::class, 'rekamstore'])->name('users')->middleware('auth','checkrole:1,2');

Route::get('rekam/antrian-pasien-edit-form/edit/{id}', [RekamController::class, 'edit'])->name('users')->middleware('auth','checkrole:1,2');

Route::post('rekam/update/{id}', [RekamController::class, 'update'])->name('users')->middleware('auth','checkrole:1,2');

Route::get('antrian/delete/{id}', [RekamController::class, 'destroy'])->name('users')->middleware('auth','checkrole:1,2');

Route::get('pasien/{od:od}/editrekam/{id:id}', [RekamController::class, 'editrekam'])->name('users')->middleware('auth','checkrole:1,2');

Route::post('updaterekamadmin', [RekamController::class, 'updaterekam'])->name('users')->middleware('auth','checkrole:1,2');

Route::get('rekam/delete/{id}', [RekamController::class, 'destroy'])->name('users')->middleware('auth','checkrole:1,2');

Route::get('rekam/diagnosa', [RekamController::class, 'diagnosa'])->name('users')->middleware('auth','checkrole:1,2');

Route::get('rekam/diagnosatools/edit{id}', [RekamController::class, 'editdiagnosa'])->name('users')->middleware('auth','checkrole:1,2');

Route::post('rekam/diagnosatools/update/{id}', [RekamController::class, 'updatediagnosa'])->name('users')->middleware('auth','checkrole:1,2');




