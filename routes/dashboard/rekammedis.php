<?php

use App\Http\Controllers\MenuC;
use App\Http\Controllers\Module\MedicalRecordC;
use Illuminate\Support\Facades\Route;

// after login
Route::group(['middleware' => 'auth'], function() {
    Route::get('/rekammedis', [MedicalRecordC::class, 'index'])->name('rekammedis');

    Route::get('/rekammedis/create', [MedicalRecordC::class, 'create'])->name('rekammedis-create');
    Route::post('/rekammedis/create', [MedicalRecordC::class, 'createPost'])->name('rekammedis-create');
    
    Route::get('/rekammedis/create/{id}/resep', [MedicalRecordC::class, 'createReceipt'])->name('rekammedis-create-resep');
    Route::post('/rekammedis/create/{id}/resep', [MedicalRecordC::class, 'createReceiptPost'])->name('rekammedis-create-resep');

    Route::get('/rekammedis/create/{id}/periksa', [MedicalRecordC::class, 'createInspect'])->name('rekammedis-create-inspect');
    Route::post('/rekammedis/create/{id}/periksa', [MedicalRecordC::class, 'createInspectPost'])->name('rekammedis-create-inspect');

    Route::get('/rekammedis/{id}', [MedicalRecordC::class, 'edit'])->name('rekammedis-edit');
    Route::get('/rekammedis/detail/{id}', [MedicalRecordC::class, 'detail'])->name('rekammedis-detail');


    Route::get('/rekammedis/detail/{id}/edit_admin', [MedicalRecordC::class, 'detailAdmin'])->name('rekammedis-edit-admin');
    Route::get('/rekammedis/detail/{id}/edit_nurse', [MedicalRecordC::class, 'detailNurse'])->name('rekammedis-edit-nurse');
    Route::get('/rekammedis/detail/{id}/edit_doctor', [MedicalRecordC::class, 'detailDoctor'])->name('rekammedis-edit-doctor');
    Route::get('/rekammedis/detail/{id}/edit_cashier', [MedicalRecordC::class, 'detailCashier'])->name('rekammedis-edit-cashier');
    
    Route::post('/rekammedis/detail/{id}/submit_admin', [MedicalRecordC::class, 'detailSubmitAdmin'])->name('rekammedis-submit-admin');
    Route::post('/rekammedis/detail/{id}/submit_nurse', [MedicalRecordC::class, 'detailSubmitNurse'])->name('rekammedis-submit-nurse');
    Route::post('/rekammedis/detail/{id}/submit_doctor', [MedicalRecordC::class, 'detailSubmitDoctor'])->name('rekammedis-submit-doctor');
    Route::post('/rekammedis/detail/{id}/submit_cashier', [MedicalRecordC::class, 'detailSubmitCashier'])->name('rekammedis-submit-cashier');
    Route::get('/rekammedis/detail/{id}/finish', [MedicalRecordC::class, 'finish'])->name('rekammedis-finish');

    Route::get('/rekammedis/delete/{id}', [MedicalRecordC::class, 'delete'])->name('rekammedis-delete');
    
    
    Route::get('/rekammedis/v2/detail/periksa/{id}/', [MedicalRecordC::class, 'detailV2Check'])->name('rekammedis-v2-periksa');
    Route::post('/rekammedis/v2/detail/periksa/{id}/nurse', [MedicalRecordC::class, 'detailV2NursePost'])->name('rekammedis-v2-periksa-nurse');
    Route::post('/rekammedis/v2/detail/periksa/{id}/doctor', [MedicalRecordC::class, 'detailV2DoctorPost'])->name('rekammedis-v2-periksa-doctor');
    
    Route::get('/rekammedis/v2/detail/emr/{id}/', [MedicalRecordC::class, 'detailV2Check'])->name('rekammedis-v2-emr');
    Route::post('/rekammedis/v2/detail/emr/{id}/nurse', [MedicalRecordC::class, 'detailV2NursePost'])->name('rekammedis-v2-emr-nurse');
    Route::post('/rekammedis/v2/detail/emr/{id}/doctor', [MedicalRecordC::class, 'detailV2DoctorPost'])->name('rekammedis-v2-emr-doctor');

    Route::get('/rekammedis/v2/detail/resep/{id}', [MedicalRecordC::class, 'detailV2Prescript'])->name('rekammedis-v2-resep');

    Route::get('/rekammedis/v2/detail/tindakan/{id}', [MedicalRecordC::class, 'detailV2Action'])->name('rekammedis-v2-tindakan');
    Route::get('/rekammedis/v2/detail/biaya/{id}', [MedicalRecordC::class, 'detailV2Payment'])->name('rekammedis-v2-biaya');
    Route::get('/rekammedis/v2/detail/emr/{id}', [MedicalRecordC::class, 'detailV2Emr'])->name('rekammedis-v2-emr');




});