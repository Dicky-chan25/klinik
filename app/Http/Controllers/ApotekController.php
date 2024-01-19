<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;
use App\Models\Jenis;

class ApotekController extends Controller
{
    public function index()
    {
        // $this->authorize('superadmin');
        $today = date("d/m/Y");
        $obat = Obat::all();
        $jenis = Jenis::all();
        // $laporan =  Rekam::where('keluhan', null)->count();
        // $countpasien = Rekam::where('diagnosa', null)->count();
        return view('apotek.index', [
            'obat' => $obat,
            'jenis' => $jenis
        ]);
    }
    // public function index()
    // {
        
    //     return view('apotek.index');
    // }
}
