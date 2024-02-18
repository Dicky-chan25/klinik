<?php

use App\Http\Controllers\MenuC;
use App\Http\Controllers\Module\DoctorC;
use App\Http\Controllers\Module\MedicineAllC;
use Illuminate\Support\Facades\Route;

// after login
Route::group(['middleware' => 'auth'], function() {
    Route::get('/dokter', [DoctorC::class, 'index'])->name('dokter');
    
    Route::get('/dokter/create', [DoctorC::class, 'create'])->name('dokter-create');
    Route::post('/dokter/create', [DoctorC::class, 'createPost'])->name('dokter-create');
    
    Route::get('/dokter/{id}', [DoctorC::class, 'edit'])->name('dokter-edit');
    Route::post('/dokter/{id}', [DoctorC::class, 'editPut'])->name('dokter-edit-submit');
    
    Route::get('/dokter/detail/{id}', [DoctorC::class, 'detail'])->name('dokter-detail');
    Route::get('/dokter/delete/{id}', [DoctorC::class, 'delete'])->name('dokter-delete');
});