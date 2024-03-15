<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use App\Http\Requests\ObatNonRacikReq;
use App\Http\Requests\ObatRacikReq;
use App\Models\Clinic\CompoundingMdc;
use App\Models\Clinic\MedicalRecord;
use App\Models\Clinic\MedicalRecord\Assesment;
use App\Models\Clinic\MedicalRecord\ObatNonRacik;
use App\Models\Clinic\MedicalRecord\ObatRacik;
use App\Models\Clinic\Medicine;
use App\Models\Clinic\Registration;
use App\Models\MenuAccess;
use App\Models\Menus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CarePatientC extends Controller
{

    public function detail($id)
    {
        $query =  Registration::select(
            'c_patient.patientname as patientName',
            'c_patient.gender as gender',
            'c_patient.address as address',
            'm_staff.name as doctorName',
            'c_patient.birthdate as birthDate',
            'c_patient.birthplace as birthPlace',
            'c_registration.reg_no as regNo',
            'c_registration.rm_code as rmCode',
            'c_registration.ass_code as assCode',
            'c_registration.onr_code as onrCode',
            'c_registration.or_code as orCode',
            'c_registration.act_code as actCode',
            'c_registration.lab_code as labCode',
            'c_registration.payment_method as payMethod',
            'c_registration.alergy as alergy',
            'c_registration.created_at as createdAt',
        )
        ->leftJoin('c_patient', 'c_registration.patient_id', 'c_patient.id')
        ->leftJoin('c_doctor', 'c_registration.doctor_id', 'c_doctor.id')
        ->leftJoin('m_staff', 'c_doctor.staff_id', 'm_staff.id')
        ->where('c_registration.id', $id)
        ->first();

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

        $dataResultToday = Registration::select(
            'c_registration.id as id',
            'c_patient.patientname as name',
            'c_patient.gender as gender',
            'c_registration.rm_code as rmCode',
            'c_registration.reg_no as regNo',
            'c_registration.nursing_status as nursingStatus',
            'c_registration.is_call as isCall',
            'c_registration.created_at as createdAt',
            'c_registration.queue_no as queueNo',
        )
        ->leftJoin('c_patient', 'c_registration.patient_id', 'c_patient.id')
        ->whereRaw('c_registration.is_submit = 1 AND c_registration.status in (0,1) AND c_registration.deleted_at IS NULL')
        ->paginate(5);

        return view('dashboard.care_patient.index', compact(
            'dataResultToday',
            'access',
            'search',
            'fromdate',
            'todate'
        ));
    }

    public function callSubmit($id){
        Registration::where('id', $id)->update([
            'is_call' => Auth::user()->id,
        ]);
        Session::flash('success', 'Nomor Antrian Berhasil DiPanggil');
        return redirect()->route('rawatpasien');
    }

    public function assesment($id){

        $detailData = $this->detail($id);
        $detailAssesment = Assesment::select(
            'c_medical_r_assesment.id as id',
            'c_medical_r_assesment.weight as weight',
            'c_medical_r_assesment.height as height',
            'c_medical_r_assesment.temp as temp',
            'c_medical_r_assesment.blood_press as bp',
            'c_medical_r_assesment.pulse as pulse',
            'c_medical_r_assesment.blood_id as blood',
            'c_medical_r_assesment.subject as subject',
            'c_medical_r_assesment.object as object',
            'c_medical_r_assesment.assesment as assesment',
            'c_medical_r_assesment.plan as plan',
            'c_medical_r_assesment.color_blind as cb',
            'c_medical_r_assesment.status_ass as status_ass',
            'm_icd_10.title as title',
            'm_icd_10.code as code',
            'm_icd_10.desc as desc',
        )
        ->leftJoin('m_icd_10', 'c_medical_r_assesment.icd10_id', 'm_icd_10.id')
        ->where('c_medical_r_assesment.code', $detailData->assCode)
        ->first();

        $bloods = DB::table('m_blood')->get();

        return view('dashboard.care_patient.assesment', 
            compact(
                'id',
                'detailData', 
                'detailAssesment', 
                'bloods'
            )
        );
    }

    public function assesmentResult($id){
        $detailData  = $this->detail($id);
        return view('dashboard.care_patient.assesment_result', compact('id','detailData'));
    }

    public function assesmentPost(Request $req , $id){
        try {
            DB::beginTransaction();

            $bloodId = $req->blood;
            $object = $req->object;
            $assesment = $req->assesment;
            $subject = $req->subject;
            $plan = $req->plan;
            $temp = $req->temp;
            $weight = $req->weight;
            $height = $req->height;
            $pulse = $req->pulse;
            $bp = $req->blood_press;
            $cb = $req->cb;

            $detailReg = Registration::find($id);
            $detailMr = MedicalRecord::where('reg_no',$detailReg->reg_no)->first();
            
             // update assesment table
            Assesment::where('code', $detailReg->ass_code)->update([
                'rm_id' => $detailMr->id,
                'blood_id' => $bloodId,
                'object' => $object,
                'assesment' => $assesment,
                'subject' => $subject,
                'plan' => $plan,
                'temp' => $temp,
                'weight' => $weight,
                'height' => $height,
                'pulse' => $pulse,
                'blood_press' => $bp,
                'color_blind' => $cb,
                'updated_by_id' => Auth::user()->id
            ]);
            

            DB::commit();

            Session::flash('success', 'Data Assesment berhasil disimpan');
            return redirect()->to('/rawatpasien/assesment/'.$id);

        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
            DB::rollBack();
        }
    }

    public function onr($id){
        $detailData  = $this->detail($id);
        $detailOnr = ObatNonRacik::select(
            'c_medical_r_onr.id as id',
            'c_medical_r_onr.desc as desc',
        )
        ->where('c_medical_r_onr.code', $detailData->onrCode)
        ->first();
        $rule = DB::table('m_rule')->where('category', 1)->get();
        $countOnr = DB::table('c_medical_r_onr_detail')->where('onr_id', $detailOnr->id)->count();
        $getDetailOnr = DB::table('c_medical_r_onr_detail')->select(
            'c_mdc.code_mdc as codeMdc',
            'c_mdc.name as nameMdc',
            'c_mdc.exp_date as expDate',
            'c_medical_r_onr_detail.total_price as total',
            'm_unit.title as unit',
            'c_mdc.price_per_unit as ppu',
            'c_medical_r_onr_detail.qty as qty',
            'm_rule.title as rule'
        )
        ->leftJoin('c_mdc', 'c_medical_r_onr_detail.medicine_id', 'c_mdc.id')
        ->leftJoin('m_rule', 'c_medical_r_onr_detail.rule_id', 'm_rule.id')
        ->leftJoin('m_unit', 'c_mdc.unit_id', 'm_unit.id')
        ->where('c_medical_r_onr_detail.onr_id', $detailOnr->id)->get();

        return view('dashboard.care_patient.obat_nonracik', compact(
            'id',
            'detailData', 
            'detailOnr', 
            'countOnr',
            'getDetailOnr',
            'rule'
        ));
    }

    public function onrPost(ObatNonRacikReq $req, $id){
        try {
            $req->validated();
            $onr = $req->onr;
            DB::beginTransaction();

            $detailReg = Registration::find($id);
            $getOnr = DB::table('c_medical_r_onr')->where('code', $detailReg->onr_code)->first();
            $totalPrice = [];
            
            if ($onr != null) {
                foreach ($onr as $value) {
                    $getMdc = Medicine::where('code', $value['codeMdc'])->first();
                    $getRule = DB::table('m_rule')->where('title', $value['rule'])->first();
                    
                    $checkCount = DB::table('c_mdc_stock')
                                    ->where('status', 1)
                                    ->where('medicine_id', $getMdc->id)
                                    ->count();

                    // dd($checkCount);
                    if ($checkCount < $value['qty']) {
                        # code...
                        Session::flash('err', 'Stock Obat Non Racik Tidak Cukup');
                        DB::rollBack();
                        return redirect()->to('/rawatpasien/onr/'.$id);
                    }
                    // update status list c_mdc_stock
                    for ($i = 0; $i < $value['qty']; $i++) {
                        # code...
                        DB::table('c_mdc_stock')
                        ->where('status', 1)
                        ->where('medicine_id', $getMdc->id)
                        ->limit($value['qty'])
                        ->update([
                            'status' => 2
                        ]);
                    }

                    DB::table('c_medical_r_onr_detail')->insert([
                        'rule_id' => $getRule->id,
                        'qty' => $value['qty'],
                        'price' => $value['price'],
                        'total_price' => $value['qty'] * $value['price'],
                        'medicine_id' => $getMdc->id,		
                        'onr_id' => $getOnr->id,
                        'created_by_id' => Auth::user()->id,
                        'status' => 1,				
                    ]);
                    $totalPrice[] = $value['qty'] * $value['price'];
                }
            }

            DB::table('c_medical_r_onr')->where('code', $detailReg->onr_code)->update([
                'desc' => $req->desc,
                'total_price' => array_sum($totalPrice)
            ]);

            DB::commit();

            Session::flash('success', 'Data Obat Non Racik berhasil disimpan');
            return redirect()->to('/rawatpasien/onr/'.$id);

        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
            DB::rollBack();
        }
    }

    public function or($id){
        $detailData  = $this->detail($id);
        $detailOr = ObatRacik::select(
            'c_medical_r_or.id as id',
        )
        ->where('c_medical_r_or.code', $detailData->orCode)
        ->first();

        $rule = DB::table('m_rule')->where('category', 1)->get();
        $countOr = DB::table('c_medical_r_or_detail')->where('or_id', $detailOr->id)->count();
        $getDetailOr = DB::table('c_medical_r_or_detail')->select(
            'c_mdc_compounding.code as codeMdc',
            'c_mdc_compounding.name as nameMdc',
            'c_medical_r_or_detail.price as total',
        )
        ->leftJoin('c_mdc_compounding', 'c_medical_r_or_detail.mdc_comp_id', 'c_mdc_compounding.id')
        ->where('c_medical_r_or_detail.or_id', $detailOr->id)
        ->get();

        // dd(json_encode($getDetailOr));

        return view('dashboard.care_patient.obat_racik', compact(
            'id',
            'detailData', 
            'detailOr', 
            'countOr',
            'getDetailOr',
            'rule'
        ));
    }
    public function orPost(ObatRacikReq $req, $id){
        try {
            $req->validated();
            $or = $req->or;
            DB::beginTransaction();

            $detailReg = Registration::find($id);
            $getOr = DB::table('c_medical_r_or')->where('code', $detailReg->or_code)->first();
            $totalPrice = [];
            
            if ($or != null) {
                foreach ($or as $value) {
                    $getMdc = CompoundingMdc::where('code', $value['code'])->first();
                    $getRule = DB::table('m_rule')->where('title', $value['rule'])->first();

                    DB::table('c_medical_r_or_detail')->insert([
                        'rule_id' => $getRule->id,
                        'price' => $value['price'],
                        'mdc_comp_id' => $getMdc->id,		
                        'or_id' => $getOr->id,
                        'created_by_id' => Auth::user()->id,
                        'status' => 1,				
                    ]);
                    $totalPrice[] = $value['price'];
                }
            }

            DB::table('c_medical_r_or')->where('code', $detailReg->or_code)->update([
                'total_price' => array_sum($totalPrice)
            ]);

            DB::commit();

            Session::flash('success', 'Data Obat Racik berhasil disimpan');
            return redirect()->to('/rawatpasien/or/'.$id);

        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
            DB::rollBack();
        }
    }

    public function tindakan($id){
        $detailData  = $this->detail($id);
        $bloods = DB::table('m_blood')->get();

        return view('dashboard.care_patient.tindakan', compact('id','detailData', 'bloods'));
    }

    public function laborat($id){
        $detailData  = $this->detail($id);
        $bloods = DB::table('m_blood')->get();

        return view('dashboard.care_patient.laborat', compact('id','detailData', 'bloods'));
    }

    public function riwayat($id){
        $detailData  = $this->detail($id);
        $bloods = DB::table('m_blood')->get();

        return view('dashboard.care_patient.riwayat', compact('id','detailData', 'bloods'));
    }

    public function riwayatDetail($id){
        $detailData  = $this->detail($id);
        $bloods = DB::table('m_blood')->get();

        return view('dashboard.care_patient.riwayat_detail', compact('id','detailData', 'bloods'));
    }

    public function assesmentIcd10Update($id, $code, $title){
        $detailReg = Registration::find($id);
        $detailIcd10 = DB::table('m_icd_10')
                        ->where('code', $code)
                        ->where('title', $title)
                        ->first();
        Assesment::where('code', $detailReg->ass_code)
        ->update([
            'icd10_id' => $detailIcd10->id
        ]);
        return redirect()->back();
    }
    public function assesmentClose($id){
        $detailReg = Registration::find($id);
        Assesment::where('code', $detailReg->ass_code)
        ->update([
            'status_ass' => 1
        ]);
        return redirect()->back();
    }
}
