<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\Rekam;
use App\Models\Pegawai;
use App\Models\Dokter;

class HomeController extends Controller
{
    public function dashboard()
    {
        $today = date("d/m/Y");
        $pasien = Pasien::all();
        $countpasien = Rekam::where('diagnosa', null)->count();
        return view('welcome', [
            'countpasientoday' => $countpasien,
            'pasien' => $pasien,
            'pegawai' => Pegawai::all(),
            'laporan' => Rekam::where('laporan', 1)->count()
        ]);
    }
    
    public function index()
    {
        $dokter = Dokter::all();
        return view('welcome', [
            'dokter' => $dokter 
        ]);
    }
}
