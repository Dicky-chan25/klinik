<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationReq;
use App\Models\Clinic\Doctor;
use App\Models\Clinic\MedicalRecord;
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

        $regLast = Registration::orderBy('id', 'DESC')->first();
        $strReg = is_null($regLast) ? '00001' : substr($regLast->reg_no, 3); // remove character H-
        $intReg = (int)$strReg === 1 ? (int)$strReg : (int)$strReg + 1;
        $finalReg = (int)$strReg === 1 ? "REG" . date("dmy") . str_pad(($intReg), 5, "0", STR_PAD_LEFT) : "REG" . $intReg;

        $rmLast = Registration::orderBy('id', 'DESC')->first();
        $strRm = is_null($rmLast) ? '00001' : substr($rmLast->reg_no, 3); // remove character H-
        $intRm = (int)$strRm === 1 ? (int)$strRm : (int)$strRm + 1;
        $finalRm = (int)$strRm === 1 ? "RM" . date("dmy") . str_pad(($intRm + 1), 5, "0", STR_PAD_LEFT) : 'RM'.$intRm;

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
            $inReg->rm_code = $rm_code;
            $inReg->alergy = $alergy;
            $inReg->reg_no = $reg_code;
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
}
