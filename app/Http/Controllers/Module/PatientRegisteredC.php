<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationReq;
use App\Models\Clinic\Doctor;
use App\Models\Clinic\MedicalRecord;
use App\Models\Clinic\MedicalRecord\Action;
use App\Models\Clinic\MedicalRecord\Assesment;
use App\Models\Clinic\MedicalRecord\Laborat;
use App\Models\Clinic\MedicalRecord\ObatNonRacik;
use App\Models\Clinic\MedicalRecord\ObatRacik;
use App\Models\Clinic\Patient;
use App\Models\Clinic\Registration;
use App\Models\MenuAccess;
use App\Models\Menus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PatientRegisteredC extends Controller
{
    public function index(Request $request)
    {
        // validate role user, 
        if (is_null($request->segment(2))) {
            $segment = $request->segment(1);
        } else {
            $segment = $request->segment(2);
        }
        $menu = Menus::select('id')->where('routepath', $segment)->first();
        $access = MenuAccess::where('level_id', Auth::user()->level_id)->where('menu_id', $menu->id)->first();

        // filter and search detection
        $fromdate = $request->fromDate == null ? '' : $request->fromDate;
        $todate = $request->toDate == null ? '' : $request->toDate;
        $search = $request->search == null ? '' : $request->search;

        $dataResult = Registration::select(
            'c_registration.id as id',
            'c_registration.rm_code as rmCode',
            'c_registration.reg_no as regNo',
            'c_patient.patientname as name',
            'c_patient.phone as phone',
            'c_patient.identity as identity',
            'c_patient.gender as gender',
            'c_registration.is_submit as isSubmit',
            'c_registration.queue_no as queueNo',
        )
            ->leftJoin('c_patient', 'c_registration.patient_id', 'c_patient.id')
            ->whereRaw('c_registration.status in (0,1) AND c_registration.deleted_at IS NULL')
            ->paginate(5);

        return view('dashboard.master_data.patient_registered.index', compact(
            'dataResult',
            'access',
            'search',
            'fromdate',
            'todate'
        ));
    }

    public function create()
    {
        $detailData = Patient::select(
            'c_patient.patientname as name',
            'c_patient.birthplace as birthplace',
            'c_patient.birthdate as birthdate',
            'c_patient.address as address',
            'm_career.title as career'
        )->leftJoin('m_career', 'c_patient.career_id', 'm_career.id')
            ->first();

        // registration code
        $regLast = Registration::orderBy('id', 'DESC')->first();
        $strReg = is_null($regLast) ? '00001' : substr($regLast->reg_no, 3);
        $intReg = (int)$strReg === 1 ? (int)$strReg : (int)$strReg + 1;
        $finalReg = (int)$strReg === 1 ? "REG" . date("dmy") . str_pad(($intReg), 5, "0", STR_PAD_LEFT) : "REG" . $intReg;

        // medical record code
        $rmLast = MedicalRecord::orderBy('id', 'DESC')->first();
        $strRm = is_null($rmLast) ? '00001' : substr($rmLast->code, 3);
        $intRm = (int)$strRm === 1 ? (int)$strRm : (int)$strRm + 1;
        $finalRm = (int)$strRm === 1 ? "RM" . date("dmy") . str_pad(($intRm), 5, "0", STR_PAD_LEFT) : 'RM'.$intRm;
        
        // assesment code
        $assLast = Assesment::orderBy('id', 'DESC')->first();
        $strAss = is_null($assLast) ? '00001' : substr($assLast->code, 3);
        $intAss = (int)$strAss === 1 ? (int)$strAss : (int)$strAss + 1;
        $finalAss = (int)$strAss === 1 ? "ASS" . date("dmy") . str_pad(($intAss), 5, "0", STR_PAD_LEFT) : 'ASS'.$intAss;

        // obat nonracikan code
        $onrLast = ObatNonRacik::orderBy('id', 'DESC')->first();
        $strOnr = is_null($onrLast) ? '00001' : substr($onrLast->code, 3);
        $intOnr = (int)$strOnr === 1 ? (int)$strOnr : (int)$strOnr + 1;
        $finalOnr = (int)$strOnr === 1 ? "ONR" . date("dmy") . str_pad(($intOnr), 5, "0", STR_PAD_LEFT) : 'ONR'.$intOnr;

        // obat racikan code        
        $orLast = ObatRacik::orderBy('id', 'DESC')->first();
        $strOr = is_null($orLast) ? '00001' : substr($orLast->code, 3);
        $intOr = (int)$strOr === 1 ? (int)$strOr : (int)$strOr + 1;
        $finalOr = (int)$strOr === 1 ? "OR" . date("dmy") . str_pad(($intOr), 5, "0", STR_PAD_LEFT) : 'OR'.$intOr;

        // tindakan code        
        $actLast = Action::orderBy('id', 'DESC')->first();
        $strAct = is_null($actLast) ? '00001' : substr($actLast->code, 3);
        $intAct = (int)$strAct === 1 ? (int)$strAct : (int)$strAct + 1;
        $finalAct = (int)$strOr === 1 ? "ACT" . date("dmy") . str_pad(($intAct), 5, "0", STR_PAD_LEFT) : 'ACT'.$intAct;

        // laborat code
        $labLast = Laborat::orderBy('id', 'DESC')->first();
        $strLab = is_null($labLast) ? '00001' : substr($labLast->code, 3);
        $intLab = (int)$strLab === 1 ? (int)$strLab : (int)$strLab + 1;
        $finalLab = (int)$strOr === 1 ? "ACT" . date("dmy") . str_pad(($intLab), 5, "0", STR_PAD_LEFT) : 'ACT'.$intLab;


        $totalReg = Registration::count();
        $countReg = $totalReg + 1;

        $allDoctor = Doctor::select(
            'm_staff.name as name',
            'c_doctor.id as id',
        )
            ->leftJoin('m_staff', 'c_doctor.staff_id', 'm_staff.id')
            ->get();

        return view('dashboard.master_data.patient_registered.create', compact(
            'detailData',
            'finalReg',
            'countReg',
            'finalRm',
            'finalAss',
            'finalOnr',
            'finalOr',
            'finalAct',
            'finalLab',
            'allDoctor'
        ));
    }

    public function createPost(RegistrationReq $req)
    {
        try {
            //code...
            $req->validated();
            $queue_no = $req->queue_no;
            $reg_code = $req->reg_code;
            $rm_code = $req->rm_code;
            $ass_code = $req->ass_code;
            $onr_code = $req->onr_code;
            $or_code = $req->or_code;
            $act_code = $req->act_code;
            $lab_code = $req->lab_code;
            $payment_method = $req->payment_method;
            $entry_method = $req->entry_method;
            $nursing_status = $req->nursing_status;
            $payment_status = $req->payment_status;
            $admin_action = $req->admin_action;
            $alergy = $req->alergy;
            $doctor_id = $req->doctor_id;
            $patientId = $req->patient_id;

            DB::beginTransaction();

            // insert to registration table
            $inReg = new Registration();
            $inReg->queue_no = $queue_no;
            $inReg->alergy = $alergy;
            $inReg->reg_no = $reg_code;
            $inReg->rm_code = $rm_code;
            $inReg->ass_code = $ass_code;
            $inReg->onr_code = $onr_code;
            $inReg->or_code = $or_code;
            $inReg->act_code = $act_code;
            $inReg->lab_code = $lab_code;
            $inReg->doctor_id = $doctor_id;
            $inReg->patient_id = $patientId;
            $inReg->payment_method = $payment_method;
            $inReg->entry_method = $entry_method;
            $inReg->nursing_status = $nursing_status;
            $inReg->payment_status = $payment_status;
            $inReg->admin_action = $admin_action;
            $inReg->status = 1;
            $inReg->is_submit = 0;
            $inReg->created_by_id = Auth::user()->id;
            $inReg->save();

            DB::commit();

            Session::flash('success', 'Data Registrasi Baru berhasil dibuat');
            return redirect()->route('pendaftaranpasien');
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
            DB::rollBack();
            return redirect()->back();
        }
    }

    public function delete($id)
    {
        try {
            //code...
            DB::beginTransaction();

            Registration::where('id', $id)->update([
                'status' => 0, //deactive
                'deleted_by_id' => Auth::user()->id,
                'deleted_at' => Carbon::now()
            ]);

            DB::commit();

            Session::flash('success', 'Deleted Successfully');
            return back();
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
            DB::rollBack();
            return redirect()->back();
        }
    }

    public function confirm($id)
    {
        try {
            //code...
            DB::beginTransaction();

            Registration::where('id', $id)->update([
                'is_submit' => 1, // process to queue
                'updated_by_id' => Auth::user()->id,
                'updated_at' => Carbon::now()
            ]);

            $detailData = Registration::find($id);

            // insert new row for medical record
            $dataMr = MedicalRecord::insertGetId([
                'reg_no'=>$detailData->reg_no,
                'code'=>$detailData->rm_code,
                'patient_id'=>$detailData->patient_id,
                'doctor_id'=>$detailData->doctor_id,
                'status' => 1,
                'created_by_id' => Auth::user()->id,
            ]);

            // insert new row for assesment
            Assesment::insert([
                'rm_id'=>$dataMr,
                'code'=>$detailData->ass_code,
                'status' => 1,
                'created_by_id' => Auth::user()->id,
            ]);
            
            // insert new row for obat nonracikan
            ObatNonRacik::insert([
                'rm_id'=>$dataMr,
                'code'=>$detailData->onr_code,
                'status' => 1,
                'created_by_id' => Auth::user()->id,
            ]);

            // insert new row for obat racikan
            ObatRacik::insert([
                'rm_id'=>$dataMr,
                'code'=>$detailData->or_code,
                'status' => 1,
                'created_by_id' => Auth::user()->id,
            ]);

            // insert new row for action
            Action::insert([
                'rm_id'=>$dataMr,
                'code'=>$detailData->act_code,
                'status' => 1,
                'created_by_id' => Auth::user()->id,
            ]);

            // insert new row for laborat
            Laborat::insert([
                'rm_id'=>$dataMr,
                'code'=>$detailData->lab_code,
                'status' => 1,
                'created_by_id' => Auth::user()->id,
            ]);

            DB::commit();

            Session::flash('success', 'Updated Successfully');
            return back();
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
            DB::rollBack();
            return redirect()->back();
        }
    }
}
