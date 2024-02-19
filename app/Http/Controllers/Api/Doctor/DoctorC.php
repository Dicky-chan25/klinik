<?php

namespace App\Http\Controllers\Api\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Clinic\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DoctorC extends Controller
{
    // API Select2
    public function getData(){
        $data = Doctor::whereIn('status', [0,1])->where('doctorname', 'LIKE', '%'.request()->query('term').'%')->get();
        return response()->json($data);
    }

    public function getDataSpecialize(){
        $data = DB::table('m_specialize')
        ->where('title', 'LIKE', '%'.request()->query('term').'%')->get();
        return response()->json($data);
    }

    public function getDataUser(){
        $data = DB::table('users')
        ->where('doctorcode', '!=', '')
        ->where('email', 'LIKE', '%'.request()->query('term').'%')->get();
        return response()->json($data);
    }
}
