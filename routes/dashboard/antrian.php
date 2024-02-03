<?php

use App\Http\Controllers\MenuC;
use App\Http\Controllers\Module\PatientC;
use Illuminate\Support\Facades\Route;

// after login
Route::group(['middleware' => 'auth'], function() {
        Route::get('/antrian', [PatientC::class, 'index'])->name('antrian');
        Route::get('/antrian/create', [PatientC::class, 'create'])->name('antrian-create');
        Route::get('/antrian/{id}', [PatientC::class, 'edit'])->name('antrian-edit');
        Route::get('/antrian/detail/{id}', [PatientC::class, 'detail'])->name('antrian-detail');
        Route::post('/antrian/create', [PatientC::class, 'createPost'])->name('antrian-create');
        Route::post('/antrian/{id}', [PatientC::class, 'editPut'])->name('antrian-edit-submit');
        Route::get('/antrian/delete/{id}', [PatientC::class, 'delete'])->name('antrian-delete');
});