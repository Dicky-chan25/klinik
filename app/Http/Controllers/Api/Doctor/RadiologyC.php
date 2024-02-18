<?php

namespace App\Http\Controllers\Api\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\RadiologyReq;
use App\Models\Clinic\Doctor;
use App\Models\Clinic\Radiology;
use App\Models\PrescriptRadio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RadiologyC extends Controller
{
    public function getData($rmId){
        $data = PrescriptRadio::select('code')
                ->where('mr_id', $rmId)
                ->get();
        return response()->json($data);
    }

    public function postData(RadiologyReq $req, $rmId){
        try {
            
            $req->validated();

            $doctorId = $req->reffering_dr;
            $diagnosis = $req->diagnosis;
            $info = $req->info;
            $radio_dr = $req->radio_dr;
            $checked_date = $req->checked_date;
            $checkRadio = $req->input('radio');
            $radioList = [];

            foreach ($checkRadio as $key => $value) {
                if ($value == 'on') {
                    $radioList[] = $key;
                }
            }
            
            DB::beginTransaction();

            $preLast = PrescriptRadio::orderBy('id', 'DESC')->first();
            $strPre = is_null($preLast) ? '0000000001' : substr($preLast->code, 2); // remove character H-
            $intPre = (int)$strPre;
            $finalCode = "RD" . str_pad(($intPre + 1), 10, "0", STR_PAD_LEFT);

            $checkUser = User::select('doctorcode')->where('id', Auth::user()->id)->first();
            $doctorData = Doctor::where('code', $checkUser->doctorcode)->first();

            if (is_null($doctorData)) {
                # code...
                DB::rollBack();
                return response()->json([
                    'statusCode' => 501,
                    'message' => 'Anda login dengan akun bukan dokter'
                ]);
            }

            PrescriptRadio::insert([
                'code' => $finalCode,
                'mr_id' => $rmId,
                'radio_dr_id' => $radio_dr,
                'diagnosis' => $diagnosis,
                'info' => $info,
                'radio_list' => implode(';',$radioList),
                'checked_at' => $checked_date,
                'doctor_id' => $doctorData->id,
                'created_by_id' => Auth::user()->id,
                'status' => 1,
            ]);

            DB::commit();
            
            return response()->json([
                'statusCode' => 201,
                'message' => 'Success Created Request Radio'
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
