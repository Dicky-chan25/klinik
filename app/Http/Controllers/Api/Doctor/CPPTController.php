<?php

namespace App\Http\Controllers\Api\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Clinic\Cppt;
use App\Models\Clinic\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CPPTController extends Controller
{
    public function getData($rmId) {
        $data = Cppt::select(
            'c_cppt.created_at as createdAt',
            'c_cppt.code as code',
            'users.firstname as username',
            'c_doctor.doctorname as doctor'
        )
        ->leftJoin('c_doctor', 'c_cppt.doctor_id', 'c_doctor.id')
        ->leftJoin('users', 'c_cppt.created_by_id', 'users.id')
        ->where('mr_id', $rmId)
        ->get();
        return response()->json($data);
    }

    public function postData(Request $req, $rmId){
        try {
            
            $req->validate([
                'heartrate' => 'required',
                'temp' => 'required',
                'resprate' => 'required',
                'sp' => 'required',
                'bloodpress' => 'required',
                'bloodpress2' => 'required',
                'plan' => 'required',
                'analysis' => 'required',
                'object' => 'required',
                'subject' => 'required',
            ]);
            $vsHr=$req->heartrate;
            $vsTemp=$req->temp;
            $vsRr=$req->resprate;
            $vsSp=$req->sp;
            $vsBp=$req->bloodpress + $req->bloodpress2;
            $plan=$req->plan;
            $analysis=$req->analysis;
            $object=$req->object;
            $subject=$req->subject;
            
            DB::beginTransaction();

            $preLast = DB::table('c_medical_r_doctor_lab')->orderBy('id', 'DESC')->first();
            $strPre = is_null($preLast) ? '0000000001' : substr($preLast->code, 2); // remove character H-
            $intPre = (int)$strPre;
            $finalCode = "CT" . str_pad(($intPre + 1), 10, "0", STR_PAD_LEFT);

            $checkUser = User::select('doctorcode')->where('id', Auth::user()->id)->first();
            $checkDoctor = Doctor::where('code', $checkUser->doctorcode)->first();

            Cppt::insert([
                'mr_id' => $rmId,
                'code' => $finalCode,
                'vs_hr' => $vsHr,
                'vs_temp' => $vsTemp,
                'vs_rr' => $vsRr,
                'vs_sp' => $vsSp,
                // 'vs_bs' => $vsBs,
                'vs_bp' => $vsBp,
                'plan' => $plan,
                'analysis' => $analysis,
                'object' => $object,
                'subject' => $subject,
                'doctor_id' => $checkDoctor->id,
                'created_by_id' => Auth::user()->id,
                'status' => 1,

            ]);

            DB::commit();
            
            return response()->json([
                'statusCode' => 201,
                'message' => 'Success Created Request Lab'
             ]);
        } catch (\Throwable $th) {
             //throw $th;
             dd($th);
             DB::rollBack();
             return response()->json([
                'statusCode' => 500,
                'message' => 'Something Error, Please Refresh Page'
             ]);
        }
    }
}
