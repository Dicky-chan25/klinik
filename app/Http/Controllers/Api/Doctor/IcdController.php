<?php

namespace App\Http\Controllers\Api\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Clinic\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IcdController extends Controller
{
    // list icd 10
    public function dataIcd10(){
        $data = DB::table('m_icd_10')
        ->where('title', 'LIKE', '%'.request()->query('term').'%')
        ->get();
        return response()->json($data);
    }
    // list icd 9
    public function dataIcd9(){
        $data = DB::table('m_icd_9')
        ->where('title', 'LIKE', '%'.request()->query('term').'%')
        ->get();
        return response()->json($data);
    }




    // list icd 10 where rmId in prescription
    public function getData10($rmId){
        $data = DB::table('c_medical_r_doctor_icd10')
        ->select(
            'm_icd_10.code',
            'm_icd_10.title',
            'c_medical_r_doctor_icd10.cod',
            'c_medical_r_doctor_icd10.diagnose_cat',
        )
        ->leftJoin('m_icd_10','c_medical_r_doctor_icd10.icd10_id','m_icd_10.id')    
        ->where('mr_id', $rmId)
        ->get();
        return response()->json($data);
    }

    // post icd 10 where rmId in prescription
    public function postData10(Request $req, $rmId){
        try {
    
            $req->validate([
                'icd10_diagnose' => 'required',
                'icd10_is_new' => 'required',
                'icd10_category' => 'required',
            ]);

            $diagnose = $req->icd10_diagnose;
            $isNew = $req->icd10_is_new;
            $category = $req->icd10_category;

            DB::beginTransaction();

            $checkUser = User::select('doctorcode')->where('id', Auth::user()->id)->first();
            $checkDoctor = Doctor::where('code', $checkUser->doctorcode)->first();

            if (is_null($checkDoctor)) {
                # code...
                DB::rollBack();
                return response()->json([
                    'statusCode' => 501,
                    'message' => 'Anda login dengan akun bukan dokter'
                ]);
            }

            DB::table('c_medical_r_doctor_icd10')->insert([
                'mr_id' => $rmId,
                'icd10_id' => $diagnose,
                'cod' => $isNew,
                'diagnose_cat' => $category,
                'doctor_id' => $checkDoctor->id,
                'created_by_id' => Auth::user()->id,
                'status' => 1,
            ]);

            DB::commit();
            
            return response()->json([
                'statusCode' => 201,
                'message' => 'Success Created ICD-10 Diagnose'
             ]);
        } catch (\Throwable $th) {
             //throw $th;
            //  dd($th);
             DB::rollBack();
             return response()->json([
                'statusCode' => 500,
                'message' => 'Something Error, Please Refresh Page'
             ]);
        }
    }

    // list icd 9 where rmId in prescription
    public function getData9($rmId){
        $data = DB::table('c_medical_r_doctor_icd9')
        ->select(
            'm_icd_9.code',
            'm_icd_9.title',
            'c_medical_r_doctor_icd9.cod',
            'c_medical_r_doctor_icd9.diagnose_cat',
        )
        ->leftJoin('m_icd_9','c_medical_r_doctor_icd9.icd9_id','m_icd_9.id')    
        ->where('mr_id', $rmId)
        ->get();
        return response()->json($data);
    }

    // post icd 9 where rmId in prescription
    public function postData9(Request $req, $rmId){
        try {
            $req->validate([
                'icd9_diagnose' => 'required',
                'icd9_is_new' => 'required',
                'icd9_category' => 'required',
            ]);

            $diagnose = $req->icd9_diagnose;
            $isNew = $req->icd9_is_new;
            $category = $req->icd9_category;

            DB::beginTransaction();

            $checkUser = User::select('doctorcode')->where('id', Auth::user()->id)->first();
            $checkDoctor = Doctor::where('code', $checkUser->doctorcode)->first();

            if (is_null($checkDoctor)) {
                # code...
                DB::rollBack();
                return response()->json([
                    'statusCode' => 501,
                    'message' => 'Anda login dengan akun bukan dokter'
                ]);
            }

            DB::table('c_medical_r_doctor_icd9')->insert([
                'mr_id' => $rmId,
                'icd9_id' => $diagnose,
                'cod' => $isNew,
                'diagnose_cat' => $category,
                'doctor_id' => $checkDoctor->id,
                'created_by_id' => Auth::user()->id,
                'status' => 1,
            ]);

            DB::commit();
            
            return response()->json([
                'statusCode' => 201,
                'message' => 'Success Created ICD-9 Diagnose'
             ]);
        } catch (\Throwable $th) {
             //throw $th;
            //  dd($th);
             DB::rollBack();
             return response()->json([
                'statusCode' => 500,
                'message' => 'Something Error, Please Refresh Page'
             ]);
        }
    }
}
