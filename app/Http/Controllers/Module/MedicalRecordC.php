<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use App\Http\Requests\InspectionReq;
use App\Http\Requests\MedicalRecordReq;
use App\Http\Requests\MrNurseReq;
use App\Http\Requests\PrescriptionReq;
use App\Models\Clinic\Doctor;
use App\Models\Clinic\Inspection;
use App\Models\Clinic\InspectList;
use App\Models\Clinic\MedicalRecord;
use App\Models\Clinic\MedicalRecord\NurseCheck;
use App\Models\Clinic\MedicineStock;
use App\Models\Clinic\Patient;
use App\Models\Clinic\Payment;
use App\Models\Clinic\Polis;
use App\Models\Clinic\Prescription;
use App\Models\MenuAccess;
use App\Models\Menus;
use App\Models\Services;
use App\Models\User;
use App\Models\UserLevels;
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
        $endWhereQry = 'c_medical_record.status in (0,1,2,3,4,5,6) AND c_medical_record.deleted_at IS NULL';
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
        $roleId = Auth::user()->level_id;
        $menu = Menus::select('id')->where('routepath', $segment)->first();
        $access = MenuAccess::where('level_id',$roleId )->where('menu_id', $menu->id)->first();
        $role = UserLevels::find($roleId);
        
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
        ->orderBy('c_medical_record.updated_at','desc')
        ->paginate(10);

        return view('dashboard.medical_record.index', compact(
            'dataResult',
            'access',
            'search',
            'fromdate',
            'todate',
            'role'
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
            $status = 1;

            // $blood = $req->blood;
            // $weight = $req->weight;
            // $height = $req->height;
            // $waist = $req->waist;
            // $complain = $req->complain;
            // $diagnose = $req->diagnose;
            // $action = $req->action;
            // $type = $req->type;

            DB::beginTransaction();
            // insert to medical record table
            $insertMr = new MedicalRecord();
            $insertMr->rm_code = $rm_code;
            $insertMr->patient_id = $patient;
            $insertMr->doctor_id = $doctor;
            $insertMr->service_id = $service;
            $insertMr->poli_id = $poli;
            $insertMr->admin_id = Auth::user()->id;
            $insertMr->status = $status;
            $insertMr->save();

            // $insertMr->blood_id = $blood;
            // $insertMr->weight = $weight;
            // $insertMr->height = $height;
            // $insertMr->waist = $waist;
            // $insertMr->complaint = $complain;
            // $insertMr->diagnose = $diagnose;
            // $insertMr->action = $action;
            // $lastInsertId = $insertMr->id;

            DB::commit();

            Session::flash('success', 'Data Rekam Medis Baru berhasil dibuat');
            return redirect()->route('rekammedis');
            // if ($type == 0) {
            //     Session::flash('success', 'Data Rekam Medis Baru berhasil dibuat');
            //     # if save and back to /rekammedis
            // }else if ($type == 1) {
            //     Session::flash('success', 'Data Rekam Medis Baru berhasil dibuat');
            //     # if save and next to create receipt
            //     return redirect()->route('rekammedis-create-resep', ['id' => $lastInsertId]);
            // } else {
            //     Session::flash('warning', 'Data disimpan dalam arsip, Anda harus melengkapinya sebelum masuk ke tambah resep obat');
            //     return redirect()->route('rekammedis');
            // }

        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
            DB::rollBack();
        }
    }
    public function create(){
        $role = UserLevels::find(Auth::user()->level_id);
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
            'doctors',
            'services',
            'polis',
            'patients', 
            'bloods' , 
            'rmCode',
            'role'
        ));
    }

    public function createReceipt($id){
        $idMr = $id;
        // generate medicine code
        $dt = Carbon::now()->format('ymdhms');
        $mCode  = 'PR-'.$dt.$this->generateRandomString(5);
        $dataPatient = $this->detailPatient($id);

        $ignoreDeletePres = "c_prescription.mr_id = '".$id."' AND c_prescription.status in (0,1) AND c_prescription.deleted_at IS NULL";
        $allPrescription = Prescription::select(
            'c_prescription.code as resepCode',
            'c_medicine.medicinename as nameMedicine',
            'm_age_range.agename as ageName',
            'c_medicine_category.title as category',
            'c_prescription.qty as qty',
            'c_prescription.info as info',
            'c_prescription.created_at as createdAt',
        )
        ->leftJoin('c_medicine', 'c_prescription.medicine_id', 'c_medicine.id')
        ->leftJoin('c_medicine_d', 'c_prescription.medicine_d_id', 'c_medicine_d.id')
        ->leftJoin('m_age_range', 'c_medicine_d.age_status', 'm_age_range.id')
        ->leftJoin('c_medicine_category', 'c_medicine_d.m_category_id', 'c_medicine_category.id')
        ->whereRaw($ignoreDeletePres)->get();

        return view('dashboard.medical_record.create_resep', compact(
            'idMr',
            'mCode',
            'dataPatient',
            'allPrescription'
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
            return redirect()->route('rekammedis-edit-doctor', ['id' =>$id ]);

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
            $info = $req->info;
            $insp = InspectList::find($req->inspect);
            $mrId = $id;
            $status = 1;

            DB::beginTransaction();
            // insert to medical record table
            $insertInsp = new Inspection();
            $insertInsp->code = $code;
            $insertInsp->inspect_id = $insp->id;
            $insertInsp->mr_id = $mrId;
            $insertInsp->info = $info;
            $insertInsp->created_by_id = Auth::user()->id;
            $insertInsp->status = $status;
            $insertInsp->save();

            DB::commit();

            Session::flash('success', 'Data Pemeriksaan Tambahan berhasil dibuat');
            return redirect()->route('rekammedis-edit-doctor', ['id' =>$id ]);

        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
            DB::rollBack();
            Session::flash('error', 'Something Error, Please Refresh Page');
            
        }
    }

    public function detailAdmin($id){
        $dataMr = MedicalRecord::select(
            'c_medical_record.id as id',
            'c_medical_record.rm_code as code',
            'c_medical_record.status as status',
            'c_patient.patientname as patientName',
            'm_polis.poliname as poliName',
            'c_service.name_service as serviceName',
        )
        // patient
        ->leftJoin('c_patient','c_medical_record.patient_id','c_patient.id')
        // poli
        ->leftJoin('m_polis','c_medical_record.poli_id','m_polis.id')
        // service
        ->leftJoin('c_service','c_medical_record.service_id','c_service.id')
        ->where('c_medical_record.id', $id)
        ->first();

        $ignoreDelete = 'status in (0,1) AND deleted_at IS NULL';
        $services = Services::select('id', 'name_service as title')->whereRaw($ignoreDelete)->get();
        $polis = Polis::select('id', 'poliname as title')->whereRaw($ignoreDelete)->get();
        
        return view('dashboard.medical_record.proccess.admin',compact(
            'dataMr',
            'services',
            'polis'
        ));
    }
    public function detailNurse($id){
        $dataMr = MedicalRecord::select(
            'c_medical_record.id as id',
            'c_medical_record.rm_code as code',
            'c_medical_record.weight as weight',
            'c_medical_record.height as height',
            'c_medical_record.waist as waist',
            'c_medical_record.complaint as complain',
            'c_medical_record.diagnose as diagnose',
            'c_medical_record.status as status',
            'c_patient.patientname as patientName',
            'm_polis.poliname as poliName',
            'c_service.name_service as serviceName',
            'm_blood.title as blood',
            'c_doctor.doctorname as doctorName',
        )
        // patient
        ->leftJoin('c_patient','c_medical_record.patient_id','c_patient.id')
        // poli
        ->leftJoin('m_polis','c_medical_record.poli_id','m_polis.id')
        // doctor
        ->leftJoin('c_doctor','c_medical_record.doctor_id','c_doctor.id')
        // blood
        ->leftJoin('m_blood','c_medical_record.blood_id','m_blood.id')
        // service
        ->leftJoin('c_service','c_medical_record.service_id','c_service.id')
        ->where('c_medical_record.id', $id)
        ->first();

        $ignoreDelete = 'status in (0,1) AND deleted_at IS NULL';
        $doctors =  Doctor::select('id', 'doctorname as title')->whereRaw($ignoreDelete)->get();
        $bloods = DB::table('m_blood')->get();

        return view('dashboard.medical_record.proccess.nurse',compact(
            'dataMr',
            'doctors',
            'bloods'
        ));
    }
    public function detailDoctor($id){
        $ignoreDelete = 'status in (0,1) AND deleted_at IS NULL';
        $ignoreDeletePres = "c_prescription.mr_id = '".$id."' AND c_prescription.status in (0,1) AND c_prescription.deleted_at IS NULL";
        $ignoreDeleteInsp = "mr_id = '".$id."' AND c_inspection.status in (0,1) AND c_inspection.deleted_at IS NULL";
        
        $dataMr = MedicalRecord::select(
            'c_medical_record.id as id',
            'c_medical_record.rm_code as code',
            'c_medical_record.weight as weight',
            'c_medical_record.height as height',
            'c_medical_record.waist as waist',
            'c_medical_record.complaint as complain',
            'c_medical_record.diagnose as diagnose',
            'c_medical_record.action as action',
            'c_medical_record.status as status',
            'c_patient.patientname as patientName',
            'm_polis.poliname as poliName',
            'c_service.name_service as serviceName',
            'm_blood.title as blood',
            'c_doctor.doctorname as doctorName',
        )
        // patient
        ->leftJoin('c_patient','c_medical_record.patient_id','c_patient.id')
        // poli
        ->leftJoin('m_polis','c_medical_record.poli_id','m_polis.id')
        // doctor
        ->leftJoin('c_doctor','c_medical_record.doctor_id','c_doctor.id')
        // blood
        ->leftJoin('m_blood','c_medical_record.blood_id','m_blood.id')
        // service
        ->leftJoin('c_service','c_medical_record.service_id','c_service.id')
        ->where('c_medical_record.id', $id)
        ->first();
        $doctors =  Doctor::select('id', 'doctorname as title')->whereRaw($ignoreDelete)->get();
        
        $allPrescription = Prescription::select(
                                'c_prescription.code as resepCode',
                                'c_medicine.medicinename as nameMedicine',
                                'm_age_range.agename as ageName',
                                'c_medicine_category.title as category',
                                'c_prescription.qty as qty',
                                'c_prescription.info as info',
                                'c_prescription.created_at as createdAt',
                            )
                            ->leftJoin('c_medicine', 'c_prescription.medicine_id', 'c_medicine.id')
                            ->leftJoin('c_medicine_d', 'c_prescription.medicine_d_id', 'c_medicine_d.id')
                            ->leftJoin('m_age_range', 'c_medicine_d.age_status', 'm_age_range.id')
                            ->leftJoin('c_medicine_category', 'c_medicine_d.m_category_id', 'c_medicine_category.id')
                            ->whereRaw($ignoreDeletePres)->get();

        $allInspect = Inspection::select(
                            'c_inspection.code as ispCode',
                            'c_inspect_list.title as ispName',
                            'c_inspect_list.price as price',
                            'c_inspection.info as info',
                            'c_inspection.created_at as createdAt',
                        )
                        ->leftJoin('c_inspect_list', 'c_inspection.inspect_id', 'c_inspect_list.id')
                        ->whereRaw($ignoreDeleteInsp)->get();

        return view('dashboard.medical_record.proccess.doctor', compact(
            'dataMr',
            'doctors',
            'allPrescription',
            'allInspect'
        ));
    }
    public function detailCashier($id){
        $ignoreDelete = 'status in (0,1) AND deleted_at IS NULL';
        $ignoreDeletePres = "c_prescription.mr_id = '".$id."' AND c_prescription.status in (0,1) AND c_prescription.deleted_at IS NULL";
        $ignoreDeleteInsp = "mr_id = '".$id."' AND c_inspection.status in (0,1) AND c_inspection.deleted_at IS NULL";
        
        $dataMr = MedicalRecord::select(
            'c_medical_record.id as id',
            'c_medical_record.rm_code as code',
            'c_medical_record.weight as weight',
            'c_medical_record.height as height',
            'c_medical_record.waist as waist',
            'c_medical_record.complaint as complain',
            'c_medical_record.diagnose as diagnose',
            'c_medical_record.action as action',
            'c_medical_record.status as status',
            'c_patient.patientname as patientName',
            'm_polis.poliname as poliName',
            'c_service.name_service as serviceName',
            'm_blood.title as blood',
            'c_doctor.doctorname as doctorName',
            'c_doctor.price as doctorPrice',
        )
        // patient
        ->leftJoin('c_patient','c_medical_record.patient_id','c_patient.id')
        // poli
        ->leftJoin('m_polis','c_medical_record.poli_id','m_polis.id')
        // doctor
        ->leftJoin('c_doctor','c_medical_record.doctor_id','c_doctor.id')
        // blood
        ->leftJoin('m_blood','c_medical_record.blood_id','m_blood.id')
        // service
        ->leftJoin('c_service','c_medical_record.service_id','c_service.id')
        ->where('c_medical_record.id', $id)
        ->first();
        $doctors =  Doctor::select('id', 'doctorname as title')->whereRaw($ignoreDelete)->get();
        
        $allPrescription = Prescription::select(
                                'c_prescription.code as resepCode',
                                'c_medicine.medicinename as nameMedicine',
                                'c_medicine_d.price as priceMdc',
                                'm_age_range.agename as ageName',
                                'c_medicine_category.title as category',
                                'c_prescription.qty as qty',
                                'c_prescription.info as info',
                                'c_prescription.created_at as createdAt',
                            )
                            ->leftJoin('c_medicine', 'c_prescription.medicine_id', 'c_medicine.id')
                            ->leftJoin('c_medicine_d', 'c_prescription.medicine_d_id', 'c_medicine_d.id')
                            ->leftJoin('m_age_range', 'c_medicine_d.age_status', 'm_age_range.id')
                            ->leftJoin('c_medicine_category', 'c_medicine_d.m_category_id', 'c_medicine_category.id')
                            ->whereRaw($ignoreDeletePres)->get();

        $allInspect = Inspection::select(
                            'c_inspection.code as ispCode',
                            'c_inspect_list.title as ispName',
                            'c_inspect_list.price as price',
                            'c_inspection.info as info',
                            'c_inspection.created_at as createdAt',
                        )
                        ->leftJoin('c_inspect_list', 'c_inspection.inspect_id', 'c_inspect_list.id')
                        ->whereRaw($ignoreDeleteInsp)->get();

        $paymentData = Payment::where('mr_id', $id)->first();

        return view('dashboard.medical_record.proccess.cashier', compact(
            'dataMr',
            'doctors',
            'allPrescription',
            'allInspect',
            'paymentData'
        ));
    }

    public function detailSubmitAdmin(Request $req, $id){
        $patient = $req->patient;
        $service = $req->service;
        $poli = $req->poli;
        $type = $req->type;

        $detailMr = MedicalRecord::find($id);
        MedicalRecord::where('id', $id)->update([
            'patient_id' => is_null($patient) ? $detailMr->patient_id : $patient,
            'service_id' => is_null($service) ? $detailMr->service_id : $service,
            'poli_id' => is_null($poli) ? $detailMr->poli_id : $poli,
            'admin_id' => Auth::user()->id,
            'status' => $type == 0 ? $detailMr->status : 2
        ]);

        if ($type == 0) {
            Session::flash('success', 'Data Rekam Medis role Admin berhasil diubah');
        }
        if ($type == 1) {
            Session::flash('success', 'Data Rekam Medis role Admin berhasil Di Submit ke Perawat');
        }
        return redirect()->route('rekammedis');
    }

    public function detailSubmitNurse(Request $req, $id){
        $blood = $req->blood;
        $weight = $req->weight;
        $height = $req->height;
        $waist = $req->waist;
        $complain = $req->complain;
        $diagnose = $req->diagnose;
        $doctor = $req->doctor;
        $type = $req->type;

        $detailMr = MedicalRecord::find($id);
        MedicalRecord::where('id', $id)->update([
            'blood_id' => is_null($blood) ? $detailMr->blood_id : $blood,
            'weight' => is_null($weight) ? $detailMr->weight : $weight,
            'height' => is_null($height) ? $detailMr->height : $height,
            'waist' => is_null($waist) ? $detailMr->waist : $waist,
            'complaint' => is_null($complain) ? $detailMr->complain : $complain,
            'diagnose' => is_null($diagnose) ? $detailMr->diagnose : $diagnose,
            'nurse_id' => Auth::user()->id,
            'doctor_id' => $doctor,
            'status' => $type == 0 ? $detailMr->status : 3
        ]);

        if ($type == 0) {
            Session::flash('success', 'Data Rekam Medis role Perawat berhasil diubah');
        }
        if ($type == 1) {
            Session::flash('success', 'Data Rekam Medis role Perawat berhasil Di Submit ke Dokter');
        }
        return redirect()->route('rekammedis');
    }

    public function detailSubmitDoctor(Request $req, $id){
        $action = $req->action;
        $type = $req->type;

        $detailMr = MedicalRecord::find($id);
        $doctor = Doctor::where('user_id',Auth::user()->id)->first();
        MedicalRecord::where('id', $id)->update([
            'doctor_id' => $doctor->id,
            'action' => is_null($action) ? $detailMr->action : $action,
            'status' => $type == 0 ? $detailMr->status : 4
        ]);

        if ($type == 0) {
            Session::flash('success', 'Data Rekam Medis role Dokter berhasil diubah');
        }
        if ($type == 1) {
            Session::flash('success', 'Data Rekam Medis role Dokter berhasil Di Submit ke Pembayaran');
        }
        return redirect()->route('rekammedis');
    }

    public function detailSubmitCashier(Request $req, $id){

        $req->validate([
            'nominal' => 'required',
            'total_price' => 'required',
        ]);

        $method = $req->type;
        $totalPrice = $req->total_price;
        $nominal = $req->nominal;
        $status = 5; // submit payment

        // check just one submit
        $paymentExists = Payment::where('mr_id', $id)->first();
        if ($paymentExists) {
            Session::flash('success', 'Anda sudah pernah melakukan submit pembayaran');
            return redirect()->back();
        }

        // dd($nominal, $totalPrice, ($nominal-$totalPrice));
        if (($nominal - $totalPrice) < 0) {
            Session::flash('err', 'Maaf nominal pasien yang dibayarkan kurang dari harga total');
            return redirect()->back();
        }

        $dt = Carbon::now()->format('ymdhms');
        $trxCode  = 'TR-'.$dt.$this->generateRandomString(10);
        // create payment
        $insertPayment = new Payment();
        $insertPayment->trx = $trxCode;
        $insertPayment->mr_id = $id;
        $insertPayment->method = $method;
        $insertPayment->total_price = $totalPrice;
        $insertPayment->nominal = $nominal;
        $insertPayment->return = $nominal - $totalPrice;
        $insertPayment->status = 0; // proccess
        $insertPayment->save();

        MedicalRecord::where('id', $id)->update([
            'status' => $status
        ]);

        Session::flash('success', 'Data Pembayaran Telah Disubmit, silahkan periksa kembali sebelum Anda mengakhiri rekam medis');
        return redirect()->back();
    }

    public function finish($id) {
        MedicalRecord::where('id', $id)->update([
            'status' => 6
        ]);
        Session::flash('success', 'Rekam Medis ditutup, terimakasih telah melakukan submit rekam medis');
        return redirect()->route('rekammedis');
    }

    public function detail($id){
        $idMr = $id;
        $dt = Carbon::now()->format('ymdhms');
        $mCode  = 'PR-'.$dt.$this->generateRandomString(5);

        $ignoreDelete = "c_prescription.mr_id = '".$id."' AND c_prescription.status in (0,1) AND c_prescription.deleted_at IS NULL";
        $defaultDelete = "mr_id = '".$id."' AND status in (0,1) AND deleted_at IS NULL";
        
        $detailMr = MedicalRecord::select(
            'c_medical_record.rm_code as code',
            'c_medical_record.complaint as complain',
            'c_medical_record.diagnose as diagnose',
            'c_medical_record.action as action',
            'c_medical_record.weight as weight',
            'c_medical_record.height as height',
            'c_medical_record.waist as waist',
            'c_medical_record.status as status',
            'c_patient.patientname as patientName',
            'c_doctor.doctorname as doctorName',
            'm_polis.poliname as poliName',
            'c_service.name_service as serviceName',
            'm_blood.title as blood',
        )
        // payment
        ->leftJoin('c_payment','c_medical_record.payment_id','c_payment.id')
        // patient
        ->leftJoin('c_patient','c_medical_record.patient_id','c_patient.id')
        // doctor
        ->leftJoin('c_doctor','c_medical_record.doctor_id','c_doctor.id')
        // blood
        ->leftJoin('m_blood','c_medical_record.blood_id','m_blood.id')
        // poli
        ->leftJoin('m_polis','c_medical_record.poli_id','m_polis.id')
        // service
        ->leftJoin('c_service','c_medical_record.service_id','c_service.id')
        ->where('c_medical_record.id', $id)
        ->first();
        
        $allPrescription = Prescription::select(
            'c_prescription.code as resepCode',
            'c_medicine.medicinename as nameMedicine',
            'm_age_range.agename as ageName',
            'c_medicine_category.title as category',
            'c_prescription.qty as qty',
            'c_prescription.info as info',
            'c_prescription.created_at as createdAt',
        )
        ->leftJoin('c_medicine', 'c_prescription.medicine_id', 'c_medicine.id')
        ->leftJoin('c_medicine_d', 'c_prescription.medicine_d_id', 'c_medicine_d.id')
        ->leftJoin('m_age_range', 'c_medicine_d.age_status', 'm_age_range.id')
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
            'detailMr'
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



























































    public function detailV2Check($id){
        $dataPatient = $this->detailPatient($id);
        $roleId = Auth::user()->level_id;
        $role = UserLevels::find($roleId);

        if (strtolower($role->levelname) == 'nurse' || strtolower($role->levelname) == 'perawat') {
            return view('dashboard.medical_record.detail.check', 
            compact('dataPatient', 'id'));
        }
        if (strtolower($role->levelname) == 'doctor' || strtolower($role->levelname) == 'dokter') {
            
            $mrNurse = NurseCheck::where('mr_id', $id)->first();
            return view('dashboard.medical_record.detail.check', 
            compact('dataPatient', 'id', 'mrNurse'));
        }
    }

    public function detailV2NursePost(MrNurseReq $req, $id){
        try {
            $req->validated();
            $weight = $req->weight;
            $height = $req->height;
            $bloodpress = $req->bloodpress;
            $bloodpress2 = $req->bloodpress2;
            $heartrate = $req->heartrate;
            $resprate= $req->resprate;
            $temp = $req->temp;
            $sp = $req->sp;
            $bloodsugar = $req->bloodsugar;
            $anamnesis = $req->anamnesis;
            $physicalcheck = $req->physicalcheck;
            $diagnosis = $req->diagnosis;

            
            DB::beginTransaction();
            // insert to medical record table nurse (c_medical_r_nurse)
            $nurseCheck = new NurseCheck();
            $nurseCheck->anamnesis = $anamnesis;
            $nurseCheck->physical_check = $physicalcheck;
            $nurseCheck->diagnosis = $diagnosis;
            $nurseCheck->vs_w = $weight;
            $nurseCheck->vs_h = $height;
            $nurseCheck->vs_hr = $heartrate;
            $nurseCheck->vs_temp = $temp;
            $nurseCheck->vs_rr = $resprate;
            $nurseCheck->vs_sp = $sp;
            $nurseCheck->vs_bs = $bloodsugar;
            $nurseCheck->vs_bp = $bloodpress.'/'.$bloodpress2;
            $nurseCheck->mr_id = $id;
            $nurseCheck->created_by_id = Auth::user()->id;
            $nurseCheck->status = 1; // active
            $nurseCheck->save();

            MedicalRecord::where('id', $id)->update([
                'nurse_id' => Auth::user()->id,
                'status' => 3 // change to 'sudah diproses perawat'
            ]);

            DB::commit();

            Session::flash('success', 'Data Pemeriksaan Medis Keperawatan berhasil dibuat');
            return redirect()->route('rekammedis');

        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
            DB::rollBack();
            Session::flash('error', 'Something Error, Please Refresh Page');
        }
    }

    public function detailV2Action($id){
        return view('dashboard.medical_record.detail.action');
    }
    public function detailV2Prescript($id){
        return view('dashboard.medical_record.detail.prescript');
    }
   
    public function detailV2Payment($id){
        return view('dashboard.medical_record.detail.payment');
    }
    public function detailV2Emr($id){
        return view('dashboard.medical_record.detail.emr');
    }

    function detailPatient($id){
        $data = MedicalRecord::select(
            'c_medical_record.rm_code as code',
            'c_medical_record.status as status',
            'c_patient.patientname as patientName',
            'c_patient.identity as nik',
            'c_patient.birthdate as birthDate',
            'c_patient.gender as gender',
            'c_patient.address as address',
            'c_patient.language as language',
            'c_visitor.queue_no as queue',
            'c_visitor.reg_no as reg',
            'c_visitor.created_at as createdAt',
            'c_visitor.method as method',
            'c_visitor.payment_method as paymentMethod',
            'm_polis.poliname as poliName',
            'c_service.name_service as serviceName',
            'c_visitor.payment_method as payment',
            'c_visitor.first_diagnose as fdiagnose',
        )
        // patient profile join
        ->leftJoin('c_patient','c_medical_record.patient_id','c_patient.id')
        // patient visitor join
        ->leftJoin('c_visitor','c_medical_record.visitor_id','c_visitor.id')
        // patient poli join
        ->leftJoin('m_polis','c_visitor.poli_id','m_polis.id')
        // patient service join
        ->leftJoin('c_service','c_visitor.service_id','c_service.id')
        ->where('c_medical_record.id', $id)
        ->first();

        return $data;
    }
}
