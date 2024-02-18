<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use App\Models\Clinic\Doctor;
use Illuminate\Http\Request;

class DoctorC extends Controller
{
    public function index(){
        return view('dashboard.doctor.index');
    }

    public function getData(){
        $data = Doctor::whereIn('status', [0,1])->where('doctorname', 'LIKE', '%'.request()->query('term').'%')->get();
        // dd($data);
        return response()->json($data);
    }
}
