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
    Route::post('/rekammedis/{id}', [MedicalRecordC::class, 'editPut'])->name('rekammedis-edit-submit');
    Route::get('/rekammedis/delete/{id}', [MedicalRecordC::class, 'delete'])->name('rekammedis-delete');
});