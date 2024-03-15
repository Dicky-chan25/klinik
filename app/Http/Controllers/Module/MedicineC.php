<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use App\Http\Requests\MedicineReq;
use App\Models\Clinic\Medicine;
use App\Models\MenuAccess;
use App\Models\Menus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MedicineC extends Controller
{
    public function filter($fromdate, $todate, $search)
    {
        $dateFilter = '';
        $searchFilter = '';
        $endWhereQry = 'c_mdc.status in (0,1) AND c_mdc.deleted_at IS NULL';
        if ($fromdate != null && $todate != null) {
            $filterfromdate = implode(' ', [str_replace('-', '/', $fromdate), '00:00:00']);
            $filtertodate = implode(' ', [str_replace('-', '/', $todate), '23:59:00']);
            $dateFilter = "DATE(c_mdc.created_at) BETWEEN '$filterfromdate' AND '$filtertodate' AND ";
        }
        if ($search != '') {
            $searchFilter = "
            c_mdc.name LIKE '$search%'
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
            'c_mdc.id as medId',
            'c_mdc.code as code',
            'c_mdc.name as medName',
            'c_mdc.exp_date as exp',
            'c_mdc.price_per_unit as ppu',
            'm_unit.title as title',
            'c_mdc_category.name as nameCat',
            DB::raw('(
                SELECT
                    COUNT(*)
                FROM
                    c_mdc_stock
                WHERE
                    c_mdc_stock.medicine_id = c_mdc.id
                    AND c_mdc_stock.status = 1
            ) as stockout')
        )
        ->leftJoin('m_unit', 'c_mdc.unit_id', 'm_unit.id')
        ->leftJoin('c_mdc_category', 'c_mdc.category_id', 'c_mdc_category.id')
        ->whereRaw($this->filter($fromdate, $todate, $search))
        ->paginate(10);

        return view('dashboard.medicine.index', compact(
            'dataResult',
            'access',
            'search',
            'fromdate',
            'todate'
        ));
    }

    public function indexRacik(Request $request)
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
            'c_mdc.id as medId',
            'c_mdc.code as code',
            'c_mdc.name as medName',
            'c_mdc.exp_date as exp',
            'c_mdc.price_per_unit as ppu',
            'm_unit.title as title',
            'c_mdc_category.name as nameCat',
            DB::raw('(
                SELECT
                    COUNT(*)
                FROM
                    c_mdc_stock
                WHERE
                    c_mdc_stock.medicine_id = c_mdc.id
                    AND c_mdc_stock.status = 1
            ) as stockout')
        )
        ->leftJoin('m_unit', 'c_mdc.unit_id', 'm_unit.id')
        ->leftJoin('c_mdc_category', 'c_mdc.category_id', 'c_mdc_category.id')
        ->whereRaw($this->filter($fromdate, $todate, $search))
        ->paginate(10);

        return view('dashboard.medicine.index_racik', compact(
            'dataResult',
            'access',
            'search',
            'fromdate',
            'todate'
        ));
    }

    public function create()
    {
        // medicine code
        $mdcLast = Medicine::orderBy('id', 'DESC')->first();
        $strMdc = is_null($mdcLast) ? '00001' : substr($mdcLast->code, 3);
        $intMdc = (int)$strMdc === 1 ? (int)$strMdc : (int)$strMdc + 1;
        $mdcCode = (int)$strMdc === 1 ? "MDC" . date("dmy") . str_pad(($intMdc), 5, "0", STR_PAD_LEFT) : 'MDC'.$intMdc;
         
        $mUnit = DB::table('m_unit')->get();
        $mCategory = DB::table('c_mdc_category')->get();
        return view('dashboard.medicine.create', compact(
            'mdcCode',
            'mUnit',
            'mCategory'
        ));
    }

    public function createPost(MedicineReq $req)
    {
        try {
            $req->validated();
            $code = $req->code;
            $code_mdc = $req->code_mdc;
            $mname = $req->mname;
            $supplier = $req->supplier_id;
            $exp_date = $req->exp_date;
            $price = $req->price;
            $qty = $req->qty;
            $unit = $req->unit;
            $category = $req->category;
            $status = 1;

            DB::beginTransaction();
            // insert to medical record table
            $insertMdc = new Medicine();
            $insertMdc->code = $code;
            $insertMdc->code_mdc = $code_mdc;
            $insertMdc->name = $mname;
            $insertMdc->unit_id = $unit;
            $insertMdc->category_id = $category;
            $insertMdc->supplier_id = $supplier;
            $insertMdc->price_per_unit = $price;
            $insertMdc->exp_date = $exp_date;
            $insertMdc->qty = $qty;
            $insertMdc->created_by_id = Auth::user()->id;
            $insertMdc->status = $status;
            $insertMdc->save();
            $lastInsertId = $insertMdc->id;

            // generate medicine quantity
            for ($i = 0; $i < $qty; $i++){
                DB::table('c_mdc_stock')->insert([
                    'medicine_id' => $lastInsertId,
                    'created_by_id' => Auth::user()->id,
                    'status' => 1
                ]);
            }

            DB::commit();
            
            Session::flash('success', 'Data Obat Baru berhasil dibuat');
            return redirect()->route('obat');

        } catch (\Throwable $th) {
            dd($th);
            DB::rollBack();
        }
    }

    // public function editPut(Request $req, $id)
    // {
    //     try {
    //         Medicine::where('id',$id)->update([
    //             'medicinename' => $req->mname
    //         ]);

    //         Session::flash('success', 'Berhasil Ubah Data Obat');
    //         return redirect()->route('semuaobat');
    //     } catch (\Throwable $th) {
    //         dd($th);
    //         Session::flash('error', 'Something Error, Please Refresh Page');
    //         return back();
    //     }
    // }

    // public function delete($id)
    // {
    //     try {
    //         //code...
    //         // MedicineDetail::where('id', $id)->update([
    //         //     'status' => 0, //deactive
    //         //     'deleted_by_id' => Auth::user()->id, 
    //         //     'deleted_at' => Carbon::now()
    //         // ]);
    //         Session::flash('success', 'Deleted Successfully');
    //         return back();
    //     } catch (\Throwable $th) {
    //         dd($th);
    //         //throw $th;
    //     }
    // }
}
