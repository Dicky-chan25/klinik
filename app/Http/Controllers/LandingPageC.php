<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingPageC extends Controller
{
    public function index(){
        return view('landing-page.index');
    }
    public function newPatient($step){
        if ($step == 0) {
            return view('landing-page.new_patient_step1');
        }
        if ($step == 1) {
            return view('landing-page.new_patient_step2');
        }
    }
    public function queue(){
        return view('landing-page.register');
    }
}
