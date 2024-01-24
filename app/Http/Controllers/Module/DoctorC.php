<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DoctorC extends Controller
{
    public function index(){
        return view('dashboard.doctor.index');
    }
}
