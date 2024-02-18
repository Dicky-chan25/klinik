<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use App\Http\Requests\MedicineDetailReq;
use App\Http\Requests\MedicineReq;
use App\Models\Clinic\Medicine;
use App\Models\Clinic\MedicineCategory;
use App\Models\Clinic\MedicineDetail;
use App\Models\Clinic\MedicineIn;
use App\Models\MenuAccess;
use App\Models\Menus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MedicineAllC extends Controller
{
    public function filter($fromdate, $todate, $search)
    {
        $dateFilter = '';
        $searchFilter = '';
        $endWhereQry = 'c_medicine.status in (0,1) AND c_medicine.deleted_at IS NULL';
        if ($fromdate != null && $todate != null) {
            $filterfromdate = implode(' ', [str_replace('-', '/', $fromdate), '00:00:00']);
            $filtertodate = implode(' ', [str_replace('-', '/', $todate), '23:59:00']);
            $dateFilter = "DATE(c_medicine.created_at) BETWEEN '$filterfromdate' AND '$filtertodate' AND ";
        }
        if ($search != '') {
            $searchFilter = "
            c_medicine.medicinename LIKE '$search%'
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

        $dataResult = Medicine::select(
            'c_medicine.id as medId',
            'c_medicine.code as code',
            'c_medicine.medicinename as medName',
            'c_medicine.supplier as sName',
            'c_medicine.supplier_contact as sContact',
            'c_medicine.status as status',
            'c_medicine.created_at as createdAt',
        )->whereRaw($this->filter($fromdate, $todate, $search))
            ->paginate(10);

        return view('dashboard.medicine.all.index', compact(
            'dataResult',
            'access',
            'search',
            'fromdate',
            'todate'
        ));
    }

    public function create()
    {
         // generate medical record code
         $dt = Carbon::now()->format('ymdhms');
         $mdcCode  = 'MDC-'.$dt.$this->generateRandomString(5);
         
        return view('dashboard.medicine.all.create', compact('mdcCode'));
    }

    public function createPost(MedicineReq $req)
    {
        try {
            $req->validated();
            $code = $req->code;
            $mname = $req->mname;
            $sname = $req->sname;
            $scontact = $req->scontact;
            $type = $req->type;
            $status = 1;

            DB::beginTransaction();
            // insert to medical record table
            $insertMdc = new Medicine();
            $insertMdc->code = $code;
            $insertMdc->medicinename = $mname;
            $insertMdc->supplier = $sname; 
            $insertMdc->supplier_contact = $scontact; 
            $insertMdc->created_by_id = Auth::user()->id;
            $insertMdc->status = $status;
            $insertMdc->save();
            $lastInsertId = $insertMdc->id;

            DB::commit();
            
            Session::flash('success', 'Data Obat Baru berhasil dibuat');
            return redirect()->route('semuaobat');

        } catch (\Throwable $th) {
            Session::flash('error', 'Something Error, Please Refresh Page');
            return back();
        }
    }

    public function editPut(Request $req, $id)
    {
        try {
            Medicine::where('id',$id)->update([
                'medicinename' => $req->mname
            ]);

            Session::flash('success', 'Berhasil Ubah Data Obat');
            return redirect()->route('semuaobat');
        } catch (\Throwable $th) {
            dd($th);
            Session::flash('error', 'Something Error, Please Refresh Page');
            return back();
        }
    }

    public function delete($id)
    {
        try {
            //code...
            // MedicineDetail::where('id', $id)->update([
            //     'status' => 0, //deactive
            //     'deleted_by_id' => Auth::user()->id, 
            //     'deleted_at' => Carbon::now()
            // ]);
            Session::flash('success', 'Deleted Successfully');
            return back();
        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
        }
    }



public function detailPost(MedicineDetailReq $req, $id)
{
    try {
        $req->validated();
        $dose = $req->dose;
        $age = $req->age;
        $eating = $req->eating;
        $category = $req->category;
        $info = $req->info;

        DB::beginTransaction();
        // insert to medical record table
        // $insertDetailMdc = new MedicineDetail();
        // $insertDetailMdc->medicine_id = $id;
        // $insertDetailMdc->dose = $dose;
        // $insertDetailMdc->info = $info;
        // $insertDetailMdc->age_status = $age;
        // $insertDetailMdc->eating_status = $eating;
        // $insertDetailMdc->m_category_id = $category;
        // $insertDetailMdc->created_by_id = Auth::user()->id;
        // $insertDetailMdc->status = 1;
        // $insertDetailMdc->save();

        DB::commit();
        
        Session::flash('success', 'Data Detail Obat berhasil dibuat');
        return redirect()->back();

    } catch (\Throwable $th) {
        dd($th);
        Session::flash('error', 'Something Error, Please Refresh Page');
        return back();
    }
}

public function detail($id)
{
    $categoryMdc = MedicineCategory::get();
    $dataMdc = Medicine::find($id);

    $detailMdc = MedicineDetail::select(
        'c_medicine_d.id as id',
        'c_medicine_d.dose_min as doseMin',
        'c_medicine_d.dose_max as doseMax',
        'c_medicine_d.eating as eating',
        'c_medicine_d.created_at as createdAt',
        'm_age_range.agename as ageName',
    )
    ->leftJoin('m_age_range','c_medicine_d.age','m_age_range.id')
    ->where('c_medicine_d.medicine_id', $id)
    ->whereRaw('c_medicine_d.status in (0,1) AND c_medicine_d.deleted_at IS NULL')
    ->get();

     
    return view('dashboard.medicine.all.detail', compact(
        'id',
        'dataMdc',
        'detailMdc',
        'categoryMdc',
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
