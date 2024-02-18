<?php

use App\Http\Controllers\Module\ActionC;
use Illuminate\Support\Facades\Route;

// after login
Route::group(['middleware' => 'auth'], function() {
    Route::prefix('datamaster')->group(function () {
        Route::get('/tindakan', [ActionC::class, 'index'])->name('tindakan');
        Route::get('/tindakan/create', [ActionC::class, 'create'])->name('tindakan-create');
        Route::post('/tindakan/create', [ActionC::class, 'createPost'])->name('tindakan-create');
        Route::get('/tindakan/delete/{id}', [ActionC::class, 'delete'])->name('tindakan-delete');
        Route::get('/tindakan/edit/{id}', [ActionC::class, 'edit'])->name('tindakan-edit');
        Route::post('/tindakan/edit/{id}/submit', [ActionC::class, 'editPut'])->name('tindakan-edit-submit');
    });
});