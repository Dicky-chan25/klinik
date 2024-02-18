<?php

use App\Http\Controllers\Module\LabController;
use Illuminate\Support\Facades\Route;

// after login
Route::group(['middleware' => 'auth'], function() {
    Route::prefix('datamaster')->group(function () {
        Route::get('/laborat', [LabController::class, 'index'])->name('laborat');
        Route::get('/laborat/create', [LabController::class, 'create'])->name('laborat-create');
        Route::post('/laborat/create', [LabController::class, 'createPost'])->name('laborat-create');
        Route::get('/laborat/delete/{id}', [LabController::class, 'delete'])->name('laborat-delete');
        Route::get('/laborat/edit/{id}', [LabController::class, 'edit'])->name('laborat-edit');
        Route::post('/laborat/edit/{id}/submit', [LabController::class, 'editPut'])->name('laborat-edit-submit');
    });
});