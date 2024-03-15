<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompoundingMdcReq;
use App\Models\Clinic\CompoundingMdc;
use App\Models\MenuAccess;
use App\Models\Menus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CompoundingMedicineC extends Controller
{
    public function filter($fromdate, $todate, $search)
    {
        $dateFilter = '';
        $searchFilter = '';
        $endWhereQry = 'status in (0,1) AND deleted_at IS NULL';
        if ($fromdate != null && $todate != null) {
            $filterfromdate = implode(' ', [str_replace('-', '/', $fromdate), '00:00:00']);
            $filtertodate = implode(' ', [str_replace('-', '/', $todate), '23:59:00']);
            $dateFilter = "DATE(created_at) BETWEEN '$filterfromdate' AND '$filtertodate' AND ";
        }
        if ($search != '') {
            $searchFilter = "name LIKE '$search%' AND ";
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

        $dataResult = CompoundingMdc::whereRaw($this->filter($fromdate, $todate, $search))
        ->orderBy('updated_at')
        ->paginate(10);

        return view('dashboard.master_data.compounding_medicine.index', compact(
            'dataResult',
            'access',
            'search',
            'fromdate',
            'todate'
        ));
    }

    public function createPost(CompoundingMdcReq $req){
        try {
            $req->validated();
            $name=$req->name;
            $price=$req->price;
            $code=$req->code;
            $category=$req->category;

            DB::beginTransaction();

            // insert to action table
            $inAct = new CompoundingMdc();
            $inAct->code = $code;
            $inAct->name = $name;
            $inAct->price = $price;
            $inAct->category = $category;
            $inAct->status = 1;
            $inAct->created_by_id = Auth::user()->id;
            $inAct->save();

            DB::commit();

            Session::flash('success', 'Data Obat Racik Baru berhasil dibuat');
            return redirect()->route('obatracik');

        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
            DB::rollBack();
        }
    }
    public function create(){
        $staffRole =  DB::table('m_staff_role')->get();
        // generate code
        $codeLast = CompoundingMdc::orderBy('id', 'DESC')->first();
        $strCode = is_null($codeLast) ? '00001' : substr($codeLast->code, 3);
        $intCode = (int)$strCode === 1 ? (int)$strCode : (int)$strCode + 1;
        $actCode = (int)$strCode === 1 ? "CMD" . date("dmy") . str_pad(($intCode), 5, "0", STR_PAD_LEFT) : 'ACT'.$intCode;

        $category = DB::table('c_mdc_comp_category')->get();
        
        return view('dashboard.master_data.compounding_medicine.create', compact(
            'staffRole',
            'actCode',
            'category'
        ));
    }

    // public function delete($id){
    //     try {
    //         //code...
    //         DB::beginTransaction();
    //         Laborat::where('id', $id)->update([
    //             'status' => 0, //deactive
    //             'deleted_by_id' => Auth::user()->id,
    //             'deleted_at' => Carbon::now()
    //         ]);
    //         DB::commit();
    //         Session::flash('success', 'Data Laborat berhasil dihapus');
    //         return redirect()->route('laborat');

    //     } catch (\Throwable $th) {
    //         //throw $th;
    //         DB::rollBack();
    //     }
    // }

    // public function edit($id)
    // {
    //     $dataDetail = Laborat::find($id);
    //     $labCategory = DB::table('c_lab_category')->get();
        
    //     return view('dashboard.master_data.laboratory.edit', 
    //         compact('dataDetail','labCategory')
    //     );
    // }

    // public function editPut(Request $req, $id)
    // {
    //     try {
    //         $detailData = Laborat::where('id', $id)->first();
    //         $name = $req->name;
    //         $category = $req->lab_category;
    //         $price = $req->price;
    //         $normal = $req->normal;
    //         $status = $req->status == null || $req->status == false ? 0 : 1;

    //         Laborat::where('id',$detailData->id)->update([
    //             'name' => $name == null ? $detailData->name : $name,
    //             'category' => $category == null ? $detailData->category : $category,
    //             'normal_value' => $normal == null ? $detailData->normal_value : $normal,
    //             'price' => $price == null ? $detailData->price : $price,
    //             'status' => $status,
    //         ]);

    //         Session::flash('success', 'Ubah Laborat Berhasil');
    //         return redirect()->route('laborat');
    //     } catch (\Throwable $th) {
    //         dd($th);
    //         Session::flash('error', 'Something Error, Please Refresh Page');
    //         return back();
    //     }
    // }
}
