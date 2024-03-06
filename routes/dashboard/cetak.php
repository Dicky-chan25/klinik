<?php

use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\Route;

Route::get('/cetak_antrian/{reg_no}', [PdfController::class, 'printQueue'])->name('cetak-antrian');