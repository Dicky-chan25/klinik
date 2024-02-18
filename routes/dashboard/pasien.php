<?php

use App\Http\Controllers\MenuC;
use App\Http\Controllers\Module\PatientC;
use Illuminate\Support\Facades\Route;

// after login
Route::group(['middleware' => 'auth'], function() {
        Route::get('/pasien', [PatientC::class, 'index'])->name('pasien');
        
        Route::get('/pasien/create', [PatientC::class, 'create'])->name('pasien-create');
        Route::post('/pasien/create', [PatientC::class, 'createPost'])->name('pasien-create');
        
        Route::get('/pasien/{id}', [PatientC::class, 'edit'])->name('pasien-edit');
        Route::post('/pasien/{id}', [PatientC::class, 'editPut'])->name('pasien-edit-submit');
        
        Route::get('/pasien/detail/{id}', [PatientC::class, 'detail'])->name('pasien-detail');
        Route::get('/pasien/delete/{id}', [PatientC::class, 'delete'])->name('pasien-delete');
});