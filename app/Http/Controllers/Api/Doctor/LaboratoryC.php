<?php

namespace App\Http\Controllers\Api\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\MRLabReq;
use App\Models\Clinic\Doctor;
use App\Models\Clinic\Laboratory;
use App\Models\PrescriptLab;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LaboratoryC extends Controller
{
    public function getData($rmId){
        $data = PrescriptLab::select('code')
                ->where('mr_id', $rmId)
                ->get();
        return response()->json($data);
    }

    public function postData(MRLabReq $req, $rmId){
        try {
            
            $req->validated();

            $doctorId = $req->reffering_dr;
            $diagnosis = $req->diagnosis;
            $info = $req->info;
            $lab_dr = $req->lab_dr;
            $checked_date = $req->checked_date;
            $checkLab = $req->input('lab');
            $labList = [];

            foreach ($checkLab as $key => $value) {
                if ($value == 'on') {
                    $labList[] = $key;
                }
            }
            
            DB::beginTransaction();

            $preLast = DB::table('c_medical_r_doctor_lab')->orderBy('id', 'DESC')->first();
            $strPre = is_null($preLast) ? '0000000001' : substr($preLast->code, 2); // remove character H-
            $intPre = (int)$strPre;
            $finalCode = "L" . str_pad(($intPre + 1), 10, "0", STR_PAD_LEFT);

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

            PrescriptLab::insert([
                'code' => $finalCode,
                'mr_id' => $rmId,
                'lab_dr_id' => $lab_dr,
                'diagnosis' => $diagnosis,
                'info' => $info,
                'lab_list' => implode(';',$labList),
                'checked_at' => $checked_date,
                'doctor_id' => $doctorId,
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
