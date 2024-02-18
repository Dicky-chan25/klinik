<?php

use App\Http\Controllers\MenuC;
use App\Http\Controllers\Module\PatientC;
use App\Http\Controllers\Module\StaffC;
use Illuminate\Support\Facades\Route;

// after login
Route::group(['middleware' => 'auth'], function() {
        Route::get('/transaksi', [StaffC::class, 'index'])->name('transaksi');
        
        Route::get('/transaksi/create', [StaffC::class, 'create'])->name('transaksi-create');
        Route::post('/transaksi/create', [StaffC::class, 'createPost'])->name('transaksi-create');
        
        Route::get('/transaksi/{id}', [StaffC::class, 'edit'])->name('transaksi-edit');
        Route::post('/transaksi/{id}', [StaffC::class, 'editPut'])->name('transaksi-edit-submit');
        
        Route::get('/transaksi/detail/{id}', [StaffC::class, 'detail'])->name('transaksi-detail');
        Route::get('/transaksi/delete/{id}', [StaffC::class, 'delete'])->name('transaksi-delete');
});