<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewPatientReq;
use App\Models\Clinic\Doctor;
use App\Models\Clinic\MedicalRecord;
use App\Models\Clinic\Patient;
use App\Models\Clinic\Payment;
use App\Models\Clinic\Polis;
use App\Models\QueuePatient;
use App\Models\Services;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LandingPageC extends Controller
{
    public function index(){
        return view('landing-page.index');
    }

    public function queueReady($id){

        try {
            //code...
            $dataResult = QueuePatient::select(
                // queue data
                'c_queue.queue as queue',
                // patient data
                'c_patient.patientname as patientName',
                // service data
                'c_service.name_service as serviceName',
                // poli data
                'c_polis.poliname as poliName',
                // doctor data
                'c_doctor.doctorname as doctorName',
            )
            ->leftJoin('c_patient','c_queue.patient_id','c_patient.id')
            ->leftJoin('c_service','c_queue.service_id','c_service.id')
            ->leftJoin('c_polis','c_service.poli_id','c_polis.id')
            ->leftJoin('c_doctor','c_service.doctor_id','c_doctor.id')
            ->where('c_queue.queue', $id)
            ->first();

            // check if data not ready
            if (is_null($dataResult)) {
                # code...
                return redirect()->to('/');
            }
            
            return view('landing-page.queue_ready', compact('dataResult'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->to('/');
        }
        
    }

    public function newPatient(){
        $religion =  DB::table('m_religion')->get();
        $education =  DB::table('m_education')->get();
        $career =  DB::table('m_career')->get();
        // $polis =  Polis::where('status',1)->get();
        $services = Services::select(
            'c_service.id as serviceId',
            'c_service.name_service as nameService',
            'c_service.price as price',
            'c_doctor.doctorname as name',
            'c_schedule.title as nameSchedule',
            'c_schedule.time_from as fromSchedule',
            'c_schedule.time_to as toSchedule',
        )
        ->join('c_doctor','c_doctor.id','c_service.doctor_id')
        ->join('c_schedule','c_schedule.id','c_service.schedule_id')
        ->join('c_polis','c_polis.id','c_service.poli_id')
        ->get();

        return view('landing-page.new_patient', compact(
            'religion','education','career','services'
        ));
    }
    public function newPatientPost(Request $req){
        $queueFinal = 10;
        Session::flash('success', 'Antrian berhasil dibuat');
        return redirect()->to('/queue_ready/'.$queueFinal);
    // public function newPatientPost(NewPatientReq $req){
        try {
            $req->validated();
            $bpjs = $req->bpjs;
            $fullname = $req->fullname;
            $identity = $req->identity;
            $birthplace = $req->birthplace;
            $birthdate = $req->birthdate;
            $gender = $req->gender;
            $religion = $req->religion;
            $career = $req->career;
            $education = $req->education;
            $wa = $req->wa;
            $email = $req->email;
            $address = $req->address;
            $services = $req->service;   
    
            DB::beginTransaction();
            
            // insert to patient table
            $insertPatient = new Patient();
            $insertPatient->bpjs_number = $bpjs;
            $insertPatient->patientname = $fullname;
            $insertPatient->address = $address;
            $insertPatient->email = $email;
            $insertPatient->birthdate = $birthdate;
            $insertPatient->birthplace = $birthplace;
            $insertPatient->identity = $identity;
            $insertPatient->phone = $wa;
            $insertPatient->religion_id = $religion;
            $insertPatient->career_id = $career;
            $insertPatient->education_id = $education;
            $insertPatient->gender = $gender;
            $insertPatient->status = 1;
            $insertPatient->save();
            $lastInsertId = $insertPatient->id;

            //check queue;
            //max queue per day = 50 queue
            $maxQueuePerDay = 50;
            $totalQueue = QueuePatient::count();
            if ($maxQueuePerDay >= $totalQueue) {
                // insert to queue
                $queuePatient = new QueuePatient();
                $queuePatient->queue = $totalQueue+1;
                $queuePatient->patient_id = $lastInsertId;
                $queuePatient->service_id = $services;
                $queuePatient->status = 0; // proccess
                $queuePatient->save();
            } else {
                DB::rollBack();
                Session::flash('error', 'Antrian sudah sudah penuh, mohon kembali lagi esok hari');
                return redirect()->back();
            }

            // insert to medical record
            $insertMr = new MedicalRecord();
            $insertMr->patient_id = $lastInsertId;
            $insertMr->service_id = $services;
            $insertMr->status = 0; // proccess
            $insertMr->save();

            
            // generate transaction code
            $dt = Carbon::now()->format('ymdhms');
            $getRandString  = 'TR-'.$dt.$this->generateRandomString(20);
            // insert to payment
            $insertPayment = new Payment();
            $insertPayment->trx = $getRandString;
            $insertPayment->patient_id = $lastInsertId;
            $insertPayment->service_id = $services;
            $insertPayment->status = 0; // proccess
            $insertPayment->save();
        
            DB::commit();
            Session::flash('success', 'Antrian berhasil dibuat');
            return redirect()->route('history');
        } catch (\Throwable $th) {
            dd($th);
            DB::rollBack();
            //throw $th;
        }
    }
    public function queue(){
        return view('landing-page.queue_form');
    }
    public function history(){
        $listQueue = $dataResult = QueuePatient::select(
            // queue data
            'c_queue.queue as queue',
            'c_queue.status as status',
            // patient data
            'c_patient.patientname as patientName',
            // service data
            'c_service.name_service as serviceName',
            // poli data
            'c_polis.poliname as poliName',
            // doctor data
            'c_doctor.doctorname as doctorName',
        )
        ->leftJoin('c_patient','c_queue.patient_id','c_patient.id')
        ->leftJoin('c_service','c_queue.service_id','c_service.id')
        ->leftJoin('c_polis','c_service.poli_id','c_polis.id')
        ->leftJoin('c_doctor','c_service.doctor_id','c_doctor.id')
        ->whereIn('c_queue.status', [0,1,2])
        ->get();
        // dd(json_encode($listQueue));
        return view('landing-page.history', compact('listQueue'));
    }

    function generateRandomString($length) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
