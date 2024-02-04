<?php

use App\Http\Controllers\Module\MedicineOutC;
use Illuminate\Support\Facades\Route;

// after login
Route::group(['middleware' => 'auth'], function() {
    Route::prefix('obat')->group(function () {
        Route::get('/obatkeluar', [MedicineOutC::class, 'index'])->name('obatkeluar');
        Route::post('/obatkeluar/peritem', [MedicineOutC::class, 'perItemPost'])->name('obatkeluar-peritem');
        Route::post('/obatkeluar/perqty', [MedicineOutC::class, 'perQtyPost'])->name('obatkeluar-perqty');
    });
});