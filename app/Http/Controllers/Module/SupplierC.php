<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use App\Http\Requests\SupplierReq;
use App\Models\Clinic\Supplier;
use App\Models\MenuAccess;
use App\Models\Menus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SupplierC extends Controller
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
            $searchFilter = "suppliername LIKE '$search%' AND ";
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

        $dataResult = Supplier::select(
            'c_supplier.id as id',
            'c_supplier.suppliername as name',
            'c_supplier.officercontact as contact',
            'c_supplier.officername as officer',
            'c_supplier.address as address',
            'c_supplier.created_at as createdAt',
        )->whereRaw($this->filter($fromdate, $todate, $search))
        ->paginate(10);

        return view('dashboard.supplier.index', compact(
            'dataResult',
            'access',
            'search',
            'fromdate',
            'todate'
        ));
    }

    public function delete($id)
    {
        Supplier::where('id', $id)->update([
            'status' => 0, //deactive
            'deleted_by_id' => Auth::user()->id, 
            'deleted_at' => Carbon::now()
        ]);
        Session::flash('success', 'Deleted Successfully');
        return back();
    }

    public function createPost(SupplierReq $req){
        try {
            $req->validated();

            $officercontact = $req->officercontact;
            $officername = $req->officername;
            $address = $req->address;
            $category = $req->category;
            $suppliername = $req->suppliername;
            $status = $req->status == true ? 1 : 0;

            DB::beginTransaction();
            
            // insert to supplier table
            $inSupplier = new Supplier();
            $inSupplier->officercontact = $officercontact;
            $inSupplier->officername = $officername;
            $inSupplier->address = $address;
            $inSupplier->category = $category;
            $inSupplier->suppliername = $suppliername;
            $inSupplier->status = is_null($status) ? 1 : $status;
            $inSupplier->created_by_id = Auth::user()->id;
            $inSupplier->save();

            DB::commit();

            Session::flash('success', 'Data Supplier Baru berhasil dibuat');
            return redirect()->route('supplier');

        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
            DB::rollBack();
        }
    }
    public function create(){
        $suppCategory =  DB::table('m_supplier_category')->get();
        return view('dashboard.supplier.create', compact(
            'suppCategory'
        ));
    }

    public function edit($id)
    {
        $dataDetail = Supplier::find($id);
        $suppCategory =  DB::table('m_supplier_category')->get();
        
        return view('dashboard.supplier.edit', compact(
            'dataDetail','suppCategory'
        ));
    }


    public function editPut(Request $req, $id)
    {
        try {
           
            $officercontact = $req->officercontact;
            $officername = $req->officername;
            $address = $req->address;
            $category = $req->category;
            $suppliername = $req->supplier;
            $status = $req->status == true ? 1 : 0;

            Supplier::where('id',$id)->update([
                'officercontact' => $officercontact,
                'officername' => $officername,
                'address' => $address,
                'officername' => $officername,
                'category' => $category,
                'suppliername' => $suppliername,
                'status' => $status,
                'updated_by_id' => Auth::user()->id
            ]);

            Session::flash('success', 'Ubah Data Supplier Berhasil');
            return redirect()->route('supplier');
        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
        }
    }
}
