<?php

use App\Http\Controllers\VisitorC;
use Illuminate\Support\Facades\Route;

// after login
Route::group(['middleware' => 'auth'], function() {
        Route::get('/antrian', [VisitorC::class, 'index'])->name('antrian');
        
        Route::get('/antrian/create', [VisitorC::class, 'create'])->name('antrian-create');
        Route::post('/antrian/create', [VisitorC::class, 'createPost'])->name('antrian-create');

        Route::get('/antrian/{id}', [VisitorC::class, 'edit'])->name('antrian-edit');
        Route::get('/antrian/detail/{id}', [VisitorC::class, 'detail'])->name('antrian-detail');
       
        Route::post('/antrian/{id}', [VisitorC::class, 'editPut'])->name('antrian-edit-submit');
        Route::get('/antrian/delete/{id}', [VisitorC::class, 'delete'])->name('antrian-delete');
});