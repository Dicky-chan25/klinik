<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\Rekam;
use App\Models\User;

class SuperAdminController extends Controller
{
    public function index()
    {
        // $this->authorize('superadmin');
        $today = date("d/m/Y");
        $user = User::all();
        $pasien = Pasien::all();
        $laporan =  Rekam::where('keluhan', null)->count();
        $countpasien = Rekam::where('diagnosa', null)->count();
        return view('superadmin.index', [
            'countpasientoday' => $countpasien,
            'pasien' => $pasien,
            'user' => $user,
            'laporantoday' => $laporan
        ]);
    }
}
