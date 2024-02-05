<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use App\Http\Requests\InspectionReq;
use App\Http\Requests\MedicalRecordReq;
use App\Http\Requests\PrescriptionReq;
use App\Models\Clinic\Doctor;
use App\Models\Clinic\Inspection;
use App\Models\Clinic\MedicalRecord;
use App\Models\Clinic\Patient;
use App\Models\Clinic\Polis;
use App\Models\Clinic\Prescription;
use App\Models\MenuAccess;
use App\Models\Menus;
use App\Models\Services;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MedicalRecordC extends Controller
{
    public function filter($fromdate, $todate, $search)
    {
        $dateFilter = '';
        $searchFilter = '';
        $endWhereQry = 'c_medical_record.status in (0,1) AND c_medical_record.deleted_at IS NULL';
        if ($fromdate != null && $todate != null) {
            $filterfromdate = implode(' ', [str_replace('-', '/', $fromdate), '00:00:00']);
            $filtertodate = implode(' ', [str_replace('-', '/', $todate), '23:59:00']);
            $dateFilter = "DATE(c_medical_record.created_at) BETWEEN '$filterfromdate' AND '$filtertodate' AND ";
        }
        if ($search != '') {
            $searchFilter = "c_medical_record.rm_code LIKE '$search%' AND ";
        }

        $query = $dateFilter . $searchFilter . $endWhereQry;
        return $query;
    }

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

        $dataResult = MedicalRecord::select(
            'c_medical_record.id as rmId',
            'c_medical_record.rm_code as rmCode',
            'c_patient.patientname as patientName',
            'c_service.name_service as serviceName',
            'c_medical_record.created_at as createdAt',
            'c_medical_record.status as status'
        )
        ->leftJoin('c_patient', 'c_medical_record.patient_id', 'c_patient.id')
        ->leftJoin('c_service', 'c_medical_record.service_id', 'c_service.id')
        ->whereRaw($this->filter($fromdate, $todate, $search))
        ->paginate(10);

        return view('dashboard.medical_record.index', compact(
            'dataResult',
            'access',
            'search',
            'fromdate',
            'todate'
        ));
    }

    public function createPost(MedicalRecordReq $req){
        try {
            $req->validated();
            $rm_code = $req->code;
            $patient = $req->patient;
            $doctor = $req->doctor;
            $service = $req->service;
            $poli = $req->poli;
            $blood = $req->blood;
            $weight = $req->weight;
            $height = $req->height;
            $waist = $req->waist;
            $complain = $req->complain;
            $diagnose = $req->diagnose;
            $action = $req->action;
            $type = $req->type;
            $status = !is_null($doctor) && !is_null($action) ? 1 : 0;

            DB::beginTransaction();
            // insert to medical record table
            $insertMr = new MedicalRecord();
            $insertMr->rm_code = $rm_code;
            $insertMr->patient_id = $patient;
            $insertMr->doctor_id = $doctor;
            $insertMr->service_id = $service;
            $insertMr->poli_id = $poli;
            $insertMr->blood_id = $blood;
            $insertMr->weight = $weight;
            $insertMr->height = $height;
            $insertMr->waist = $waist;
            $insertMr->complaint = $complain;
            $insertMr->diagnose = $diagnose;
            $insertMr->action = $action;
            $insertMr->created_by_id = Auth::user()->id;
            $insertMr->status = $status;
            $insertMr->save();
            $lastInsertId = $insertMr->id;

            DB::commit();

            if ($type == 0) {
                Session::flash('success', 'Data Rekam Medis Baru berhasil dibuat');
                # if save and back to /rekammedis
                return redirect()->route('rekammedis');
            }else if ($status == 1 && $status == 1) {
                Session::flash('success', 'Data Rekam Medis Baru berhasil dibuat');
                # if save and next to create receipt
                return redirect()->route('rekammedis-create-resep', ['id' => $lastInsertId]);
            } else {
                Session::flash('warning', 'Data disimpan dalam arsip, Anda harus melengkapinya sebelum masuk ke tambah resep obat');
                return redirect()->route('rekammedis');
            }

        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
            DB::rollBack();
        }
    }
    public function create(){
        $ignoreDelete = 'status in (0,1) AND deleted_at IS NULL';
        $patients =  Patient::select('id', 'patientname as title')->whereRaw($ignoreDelete)->get();
        $doctors =  Doctor::select('id', 'doctorname as title')->whereRaw($ignoreDelete)->get();
        $services = Services::select('id', 'name_service as title')->whereRaw($ignoreDelete)->get();
        $polis = Polis::select('id', 'poliname as title')->whereRaw($ignoreDelete)->get();
        $bloods = DB::table('m_blood')->get();

        // generate medical record code
        $dt = Carbon::now()->format('ymdhms');
        $rmCode  = 'MR-'.$dt.$this->generateRandomString(10);

        return view('dashboard.medical_record.create', compact(
            'doctors','services','polis','patients', 'bloods' , 'rmCode'
        ));
    }

    public function createReceipt($id){
        $idMr = $id;
        // generate medicine code
        $dt = Carbon::now()->format('ymdhms');
        $mCode  = 'PR-'.$dt.$this->generateRandomString(5);

        return view('dashboard.medical_record.create_resep', compact(
            'idMr',
            'mCode',
        ));
    }

    public function createInspect($id){
        $idMr = $id;
        // generate medicine code
        $dt = Carbon::now()->format('ymdhms');
        $mCode  = 'ISP-'.$dt.$this->generateRandomString(5);

        return view('dashboard.medical_record.create_inspect', compact(
            'idMr',
            'mCode',
        ));
    }

    public function createReceiptPost(PrescriptionReq $req, $id){
        try {
            $req->validated();
            $code = $req->code;
            $medicine = $req->medicine;
            $prescript = $req->prescript;
            $qty = $req->qty;
            $info = $req->info;
            $mrId = $id;
            $status = 1;

            DB::beginTransaction();
            // insert to medical record table
            $insertPrescript = new Prescription();
            $insertPrescript->code = $code;
            $insertPrescript->mr_id = $mrId;
            $insertPrescript->info = $info;
            $insertPrescript->qty = $qty; // qty ini akan jadi patokan ubah status setelah pembayaran selesai
            $insertPrescript->medicine_id = $medicine;
            $insertPrescript->medicine_d_id = $prescript;
            $insertPrescript->created_by_id = Auth::user()->id;
            $insertPrescript->status = $status;
            $insertPrescript->save();

            DB::commit();

            Session::flash('success', 'Data Resep Baru berhasil dibuat');
            return redirect()->route('rekammedis-detail', ['id' => $id]);

        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
            DB::rollBack();
        }
    }
    
    public function createInspectPost(InspectionReq $req, $id){
        try {
            $req->validated();
            $code = $req->code;
            $inspectname = $req->inspectname;
            $price = $req->price;
            $info = $req->info;
            $mrId = $id;
            $status = 1;

            DB::beginTransaction();
            // insert to medical record table
            $insertInsp = new Inspection();
            $insertInsp->code = $code;
            $insertInsp->name = $inspectname;
            $insertInsp->price = $price;
            $insertInsp->mr_id = $mrId;
            $insertInsp->info = $info;
            $insertInsp->created_by_id = Auth::user()->id;
            $insertInsp->status = $status;
            $insertInsp->save();

            DB::commit();

            Session::flash('success', 'Data Pemeriksaan Lanjutan berhasil dibuat');
            return redirect()->route('rekammedis-detail', ['id' => $id]);

        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
            DB::rollBack();
        }
    }

    public function detail($id){
        $idMr = $id;
        $dt = Carbon::now()->format('ymdhms');
        $mCode  = 'PR-'.$dt.$this->generateRandomString(5);

        $ignoreDelete = "c_prescription.mr_id = '".$id."' AND c_prescription.status in (0,1) AND c_prescription.deleted_at IS NULL";
        $defaultDelete = "mr_id = '".$id."' AND status in (0,1) AND deleted_at IS NULL";
        $allPrescription = Prescription::select(
            'c_prescription.code as resepCode',
            'c_medicine.medicinename as nameMedicine',
            'c_medicine_age.agename as ageName',
            'c_medicine_category.title as category',
            'c_prescription.qty as qty',
            'c_prescription.info as info',
            'c_prescription.created_at as createdAt',
        )
        ->leftJoin('c_medicine', 'c_prescription.medicine_id', 'c_medicine.id')
        ->leftJoin('c_medicine_d', 'c_prescription.medicine_d_id', 'c_medicine_d.id')
        ->leftJoin('c_medicine_age', 'c_medicine_d.age_status', 'c_medicine_age.id')
        ->leftJoin('c_medicine_category', 'c_medicine_d.m_category_id', 'c_medicine_category.id')
        ->whereRaw($ignoreDelete)->get();

        $allInspect = Inspection::select(
            'c_inspection.code as ispCode',
            'c_inspection.name as ispName',
            'c_inspection.price as price',
            'c_inspection.info as info',
            'c_inspection.created_at as createdAt',
        )
        ->whereRaw($defaultDelete)->get();

        return view('dashboard.medical_record.detail', compact(
            'idMr', 
            'mCode',
            'allPrescription',
            'allInspect',
        ));
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
