<?php

namespace App\Http\Controllers\Dropdown;

use App\Http\Controllers\Controller;
use App\Models\Clinic\Doctor;
use App\Models\Clinic\Polis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServicesC extends Controller
{
    public function getServices(){
        // $services = Polis::select(
        //     'c_polis.id AS poliId',
        //     'c_polis.poliname AS poliName' 
        // )->leftJoin(
        //     'c_doctor_detail','c_polis.id','c_doctor_detail.poli_id'
        // )->get();

        return view('dropdown', compact('services'));
    }
    public function getDoctor(Request $req){
        $services = Doctor::select(
            ' AS polisId',
        )->where('status',1)
        ->get();

        return view('dropdown', compact('services'));
    }
}
