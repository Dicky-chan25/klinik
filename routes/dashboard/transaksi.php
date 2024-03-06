<?php

use App\Http\Controllers\MenuC;
use App\Http\Controllers\Module\PatientC;
use App\Http\Controllers\Module\TransactionC;
use Illuminate\Support\Facades\Route;

// after login
Route::group(['middleware' => 'auth'], function() {
        Route::get('/transaksi', [TransactionC::class, 'index'])->name('transaksi');
        Route::get('/transaksi/delete/{id}', [TransactionC::class, 'delete'])->name('transaksi-delete');
});