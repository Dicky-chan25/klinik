<?php

use App\Http\Controllers\Api\Doctor\CPPTController;
use App\Http\Controllers\Api\Doctor\IcdController;
use App\Http\Controllers\Api\Doctor\LaboratoryC;
use App\Http\Controllers\Api\Doctor\MedicEquipC;
use App\Http\Controllers\Api\Doctor\PrescriptionC;
use App\Http\Controllers\Api\Doctor\RadiologyC;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeC;
use App\Http\Controllers\LandingPageC;
use App\Http\Controllers\Module\DoctorC;
use App\Models\Api\Doctor\LetterC;
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

require __DIR__ . '/dashboard/settings/users.php';
require __DIR__ . '/dashboard/settings/userlevels.php';
require __DIR__ . '/dashboard/settings/menus.php';

require __DIR__ . '/dashboard/pegawai.php';
require __DIR__ . '/dashboard/dokter.php';
require __DIR__ . '/dashboard/pasien.php';
require __DIR__ . '/dashboard/rekammedis.php';
require __DIR__ . '/dashboard/antrian.php';
require __DIR__ . '/dashboard/transaksi.php';

require __DIR__ . '/dashboard/datamaster/laborat.php';
require __DIR__ . '/dashboard/datamaster/tindakan.php';

require __DIR__ . '/dashboard/obat/obatmasuk.php';
require __DIR__ . '/dashboard/obat/obatkeluar.php';
require __DIR__ . '/dashboard/obat/semuaobat.php';

// landing page
Route::get('/', [LandingPageC::class, 'index']);

Route::get('/queue_ready/{id}', [LandingPageC::class, 'queueReady'])->name('queue-ready');

Route::get('/newpatient', [LandingPageC::class, 'newPatient'])->name('new-patient');
Route::post('/newpatient', [LandingPageC::class, 'newPatientPost'])->name('new-patient');

Route::get('/queue', [LandingPageC::class, 'queue'])->name('queue');
Route::post('/queue', [LandingPageC::class, 'queuePost'])->name('queue');

Route::get('/history', [LandingPageC::class, 'history'])->name('history');

//  as guest
Route::group(['middleware' => 'guest'], function() {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
});
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// after login
Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', [HomeC::class, 'index'])->name('home');

    // API doctor
    Route::get('/doctor', [DoctorC::class, 'getData'])->name('doctor-load');
    
    // API prescript
    Route::get('/prescript/{rmId}', [PrescriptionC::class, 'getData'])->name('prescript-load');
    Route::post('/prescript/{rmId}/post', [PrescriptionC::class, 'postData'])->name('prescript-post');
    
    // API laboratory
    Route::get('/lab/{rmId}', [LaboratoryC::class, 'getData'])->name('lab-load');
    Route::post('/lab/{rmId}/post', [LaboratoryC::class, 'postData'])->name('lab-post');
    
    // API radiology
    Route::get('/radio/{rmId}', [RadiologyC::class, 'getData'])->name('radio-load');
    Route::post('/radio/{rmId}/post', [RadiologyC::class, 'postData'])->name('radio-post');
    
    // API medical equipment
    Route::get('/me/{rmId}', [MedicEquipC::class, 'getData'])->name('me-load');
    Route::post('/me/{rmId}/post', [MedicEquipC::class, 'postData'])->name('me-post');
    
    // API icd 10 & icd 9
    Route::get('/icd_10', [IcdController::class, 'dataIcd10'])->name('icd-10-load');
    Route::get('/icd_10/{rmId}', [IcdController::class, 'getData10'])->name('icd-10-loadlist');
    Route::post('/icd_10/{rmId}/post', [IcdController::class, 'postData10'])->name('icd-10-post');
    Route::get('/icd_9', [IcdController::class, 'dataIcd9'])->name('icd-9-load');
    Route::get('/icd_9/{rmId}', [IcdController::class, 'getData9'])->name('icd-9-loadlist');
    Route::post('/icd_9/{rmId}/post', [IcdController::class, 'postData9'])->name('icd-9-post');
    
    // API CPPT
    Route::get('/cppt/{rmId}', [CPPTController::class, 'getData'])->name('cppt-load');
    Route::post('/cppt/{rmId}/post', [CPPTController::class, 'postData'])->name('cppt-post');

    // API Rujukan Letter
    Route::post('/letter/{rmId}/rujukan',[LetterC::class, 'rujukanPost'])->name('rujukan');
    Route::get('/letter/{rmId}/rujukan',[LetterC::class, 'rujukanData'])->name('rujukan');
    Route::get('/letter/{rmId}/rujukan/{id}/preview',[LetterC::class, 'rujukanPreview'])->name('rujukan');
    
    // API Keterangan Sakit Letter
    Route::post('/letter/{rmId}/rujukan',[LetterC::class, 'rujukanPost'])->name('rujukan');
    Route::get('/letter/{rmId}/rujukan',[LetterC::class, 'rujukanData'])->name('rujukan');
    Route::get('/letter/{rmId}/rujukan/{id}/preview',[LetterC::class, 'rujukanPreview'])->name('rujukan');
});
