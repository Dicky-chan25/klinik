<?php

namespace App\Http\Controllers;

use App\Http\Requests\VisitorReq;
use App\Models\Clinic\MedicalRecord;
use App\Models\Clinic\Patient;
use App\Models\Clinic\Polis;
use App\Models\Clinic\Visitor;
use App\Models\MenuAccess;
use App\Models\Menus;
use App\Models\Services;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class VisitorC extends Controller
{
    public function filter($fromdate, $todate, $search)
    {
        $dateFilter = '';
        $searchFilter = '';
        $endWhereQry = 'c_visitor.status in (0,1) AND c_visitor.deleted_at IS NULL';
        if ($fromdate != null && $todate != null) {
            $filterfromdate = implode(' ', [str_replace('-', '/', $fromdate), '00:00:00']);
            $filtertodate = implode(' ', [str_replace('-', '/', $todate), '23:59:00']);
            $dateFilter = "DATE(c_visitor.created_at) BETWEEN '$filterfromdate' AND '$filtertodate' AND ";
        }
        if ($search != '') {
            $searchFilter = "
            c_visitor.reg_no LIKE '$search%'
            OR c_visitor.queue_no LIKE '$search%'
            AND ";
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

        $dataResult = Visitor::select(
            'c_visitor.id as visitorId',
            'c_visitor.reg_no as regNo',
            'c_visitor.status as status',
            'c_visitor.queue_no as queueNo',
            'c_patient.patientname as patientName',
            'm_polis.poliname as poliName',
            'c_service.name_service as serviceName',
        )
        ->leftJoin('c_patient', 'c_visitor.patient_id', 'c_patient.id')
        ->leftJoin('c_service', 'c_visitor.service_id', 'c_service.id')
        ->leftJoin('m_polis', 'c_visitor.poli_id', 'm_polis.id')
        ->whereRaw($this->filter($fromdate, $todate, $search))
        ->paginate(10);

        return view('dashboard.visitor.index', compact(
            'dataResult',
            'access',
            'search',
            'fromdate',
            'todate'
        ));
    }

    public function create(){
        $ignoreDelete = 'status in (0,1) AND deleted_at IS NULL';
        // get this day
        $totalVisitorNow = Visitor::whereDate('updated_at', '=', now())->count();
        // get no visitor
        $noVisitor = 'AN-'.str_pad(($totalVisitorNow+1),3,"0",STR_PAD_LEFT);
        // get no reg
        $noReg = 'REG-'.$this->generateRandomString(5);

        $services = Services::select('id', 'name_service as title')->whereRaw($ignoreDelete)->get();
        $polis = Polis::select('id', 'poliname as title')->whereRaw($ignoreDelete)->get();
        
        return view('dashboard.visitor.create', compact(
           'noReg',
           'noVisitor',
           'polis',
           'services'
        ));
    }

    public function createPost(VisitorReq $req){
        try {
            //code...
            $req->validated();
            $noreg = $req->noreg;
            $novisitor = $req->novisitor;
            $patient = $req->patient;
            $service = $req->service;
            $poli = $req->poli;
            $fdiagnose = $req->fdiagnose;
            $payment = $req->payment;

            DB::beginTransaction();

            // insert to visitor
            $visitorIns = new Visitor();
            $visitorIns->queue_no = $novisitor;
            $visitorIns->reg_no = $noreg;
            $visitorIns->first_diagnose = $fdiagnose;
            $visitorIns->service_id = $service;
            $visitorIns->patient_id = $patient;
            $visitorIns->poli_id = $poli;
            $visitorIns->status = 0; // proccess
            $visitorIns->method = 0; // from admin
            $visitorIns->payment_method = $payment;
            $visitorIns->created_by_id = Auth::user()->id;
            $visitorIns->save();
            $visitorId = $visitorIns->id;

            // insert to medical record
            // generate medical record code
            $dt = Carbon::now()->format('ymdhms');
            $rmCode  = 'MR-'.$dt.$this->generateRandomString(10);
            $mrInsert = new MedicalRecord();
            $mrInsert->rm_code = $rmCode;
            $mrInsert->visitor_id = $visitorId;
            $mrInsert->patient_id = $patient;
            $mrInsert->service_id = $service;
            $mrInsert->poli_id = $poli;
            $mrInsert->status = 1; // from admin
            $mrInsert->admin_id = Auth::user()->id;
            $mrInsert->save();

            DB::commit();
            
            Session::flash('success', 'Data Stock Obat Baru berhasil dibuat');
            return redirect()->route('antrian');

        } catch (\Throwable $th) {
            dd($th);
            DB::rollBack();
            Session::flash('error', 'Something Error, Please Refresh Page');
            return back();
        }
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
