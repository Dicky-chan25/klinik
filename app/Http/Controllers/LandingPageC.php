<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewPatientReq;
use App\Models\Clinic\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LandingPageC extends Controller
{
    public function index(){
        return view('landing-page.index');
    }
    public function newPatient(){
        $religion =  DB::table('m_religion')->get();
        $education =  DB::table('m_education')->get();
        $career =  DB::table('m_career')->get();
        return view('landing-page.new_patient', compact(
            'religion','education','career'
        ));
    }
    public function newPatientPost(NewPatientReq $req){
        try {
            $req->validated();
            $bpjs = $req()->bpjs;
            $fullname = $req()->fullname;
            $nik = $req()->nik;
            $birthplace = $req()->birthplace;
            $birthdate = $req()->birthdate;
            $gender = $req()->gender;
            $religion = $req()->religion;
            $career = $req()->career;
            $education = $req()->education;
            $wa = $req()->wa;
            $email = $req()->email;
            $address = $req()->address;

            $poli = $req()->poli;
            $doctor = $req()->doctor;
            $complain = $req()->complain;
    
            // insert to patient table
            Patient::insert([
                'bpjs_number' => $bpjs,
                'patientname' => $fullname,
                'address' => $address,
                'birthdate' => $birthdate,
                'birthplace' => $birthplace,
                'identity' => $nik,
                'phone' => $wa,
                'religion' => $religion,
                'career' => $career,
                'education' => $education,
                'gender' => $gender,
                'status' => 1, // active,
            ]);
    
            // insert to medical record
    
            // insert to queue
    
            // insert to transaction
        
    
            return view('landing-page.new_patient');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function queue(){
        return view('landing-page.queue_form');
    }
    public function history(){
        return view('landing-page.history');
    }
}
