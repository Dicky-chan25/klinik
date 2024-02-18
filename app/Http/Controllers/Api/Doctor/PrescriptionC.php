<?php

namespace App\Http\Controllers\Api\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\PrescriptionReq;
use App\Models\Clinic\Doctor;
use App\Models\Clinic\MedicineStock;
use App\Models\Clinic\Prescription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PrescriptionC extends Controller
{
    public function getData($rmId){
        $data = DB::table('c_medical_r_doctor_rx')
                ->select('code')
                ->where('mr_id', $rmId)
                ->get();
        return response()->json($data);
    }
    
    public function postData(PrescriptionReq $req, $rmId){
        try {
            
            $req->validated();
            $prescript = $req->prescript;
            DB::beginTransaction();

            foreach ($prescript as $value) {

                $preLast = Prescription::orderBy('id', 'DESC')->first();
                $strPre = is_null($preLast) ? '0000000001' : substr($preLast->code, 2); // remove character H-
                $intPre = (int)$strPre;
                $finalCode = "P" . str_pad(($intPre + 1), 10, "0", STR_PAD_LEFT);

                // check qty
                $qtyReady = DB::table('c_medicine_stock_d')
                ->where('status', 0)
                ->where('medicine_id', $value['mdc_id'])
                ->where('medicine_s_id', $value['stock_id'])
                ->count();

                if ($qtyReady < $value['qty']) {
                    DB::rollBack();
                    return response()->json([
                        'statusCode' => 501,
                        'message' => 'Quantity Pada '.$value['mdc_name'].'No. Reg'.$value['mdc_reg'].' Tidak Mencukupi'
                    ]);
                }

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


                Prescription::insert([
                    'code' => $finalCode,
                    'dose' => $value['dose'],
                    'mr_id' => $rmId,
                    'medicine_id' => $value['mdc_id'],
                    'medicine_s_id' => $value['stock_id'],
                    'qty' => $value['qty'],
                    'time' => $value['time'],
                    'eating' => $value['eating'],
                    'total' => $value['total'],
                    'doctor_id' => $checkDoctor->id,
                    'created_by_id' => Auth::user()->id,
                    'status' => 1,
                ]);


                MedicineStock::where('medicine_s_id', $value['stock_id'])
                ->limit($value['qty'])
                ->update([
                    'updated_by_id' => Auth::user()->id,
                    'updated_at' => Carbon::now(),
                    'status' => 1,
                ]);
            }

            DB::commit();
            
            return response()->json([
                'statusCode' => 201,
                'message' => 'Success Created Prescripts'
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
