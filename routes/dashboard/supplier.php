<?php

use App\Http\Controllers\Module\SupplierC;
use Illuminate\Support\Facades\Route;

// after login
Route::group(['middleware' => 'auth'], function() {
        Route::get('/supplier', [SupplierC::class, 'index'])->name('supplier');
        
        Route::get('/supplier/create', [SupplierC::class, 'create'])->name('supplier-create');
        Route::post('/supplier/create', [SupplierC::class, 'createPost'])->name('supplier-create');

        Route::get('/supplier/{id}', [SupplierC::class, 'edit'])->name('supplier-edit');
        Route::get('/supplier/detail/{id}', [SupplierC::class, 'detail'])->name('supplier-detail');
       
        Route::post('/supplier/{id}', [SupplierC::class, 'editPut'])->name('supplier-edit-submit');
        Route::get('/supplier/delete/{id}', [SupplierC::class, 'delete'])->name('supplier-delete');
});