<?php

use App\Http\Controllers\MenuC;
use App\Http\Controllers\Module\PatientC;
use App\Http\Controllers\Module\StaffC;
use Illuminate\Support\Facades\Route;

// after login
Route::group(['middleware' => 'auth'], function() {
        Route::get('/pegawai', [StaffC::class, 'index'])->name('pegawai');
        
        Route::get('/pegawai/create', [StaffC::class, 'create'])->name('pegawai-create');
        Route::post('/pegawai/create', [StaffC::class, 'createPost'])->name('pegawai-create');
        
        Route::get('/pegawai/{id}', [StaffC::class, 'edit'])->name('pegawai-edit');
        Route::post('/pegawai/{id}', [StaffC::class, 'editPut'])->name('pegawai-edit-submit');
        
        Route::get('/pegawai/detail/{id}', [StaffC::class, 'detail'])->name('pegawai-detail');
        Route::get('/pegawai/delete/{id}', [StaffC::class, 'delete'])->name('pegawai-delete');
});