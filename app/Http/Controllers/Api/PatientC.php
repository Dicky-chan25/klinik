<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Clinic\Patient;
use Illuminate\Http\Request;

class PatientC extends Controller
{
      // API Select2
      public function getData(){
        $data = Patient::whereIn('status', [0,1])
        ->where('patientname', 'LIKE', '%'.request()->query('term').'%')->get();
        return response()->json($data);
    }
}
