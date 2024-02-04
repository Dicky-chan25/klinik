<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use App\Models\Clinic\MedicineIn;
use App\Models\Clinic\MedicineOut;
use App\Models\Clinic\MedicineStock;
use App\Models\MenuAccess;
use App\Models\Menus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MedicineOutC extends Controller
{
    public function filter($fromdate, $todate, $search)
    {
        $dateFilter = '';
        $searchFilter = '';
        $endWhereQry = 'c_medicine_stock_d.status in (1) AND c_medicine_stock.deleted_at IS NULL';
        if ($fromdate != null && $todate != null) {
            $filterfromdate = implode(' ', [str_replace('-', '/', $fromdate), '00:00:00']);
            $filtertodate = implode(' ', [str_replace('-', '/', $todate), '23:59:00']);
            $dateFilter = "DATE(c_medicine_stock.created_at) BETWEEN '$filterfromdate' AND '$filtertodate' AND ";
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

        // $dataResult = [];
        $dataResult = MedicineIn::select(
            'c_medicine_stock_d.id as barId',
            'c_medicine_stock_d.barcode as barcode',
            'c_medicine_stock_d.status as status',
            'c_medicine_stock.supplier as supplier',
            'c_medicine.medicinename as medsName',
            'c_medicine.updated_at as updatedAt',
        )
        ->leftJoin('c_medicine','c_medicine_stock.medicine_id' ,'c_medicine.id')
        ->leftJoin('c_medicine_stock_d','c_medicine_stock.id' ,'c_medicine_stock_d.medicine_s_id')
        ->whereRaw($this->filter($fromdate, $todate, $search))
        ->orderBy('c_medicine_stock_d.updated_at', 'desc')
        ->paginate(10);

        return view('dashboard.medicine.out.index', compact(
            'dataResult',
            'access',
            'search',
            'fromdate',
            'todate'
        ));
    }

    public function perItemPost(Request $req){
        try {
            //code...
            $barcode = $req->barcode;
            if (is_null($barcode)) {
                DB::rollBack();
                Session::flash('error', 'Anda belum input barcode');
                return redirect()->back();
            }
            $getStock = MedicineStock::where('barcode', $barcode)->first();
            if (is_null($getStock)) {
                # code...
                DB::rollBack();
                Session::flash('error', 'Barcode tidak ditemukan');
                return redirect()->back();
            }
            MedicineStock::where('barcode', $barcode)
            ->update([
                'updated_by_id' => Auth::user()->id,
                'updated_at' => Carbon::now(),
                'status' => 1,
            ]);
            Session::flash('success', 'Sukses mengeluarkan item');
            return redirect()->back();
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
            DB::rollBack();
            return redirect()->back();
        }
    }

    public function perQtyPost(Request $req){
        try {
            //code...
            $medicine = $req->medicine;
            $qty = $req->qty;
            if (is_null($medicine)) {
                DB::rollBack();
                Session::flash('error', 'Anda belum input data obat');
                return redirect()->back();
            }
            if (is_null($qty)) {
                DB::rollBack();
                Session::flash('error', 'Anda belum input data jumlah stock obat');
                return redirect()->back();
            }

            // validation check qty
            $mdcStock = MedicineStock::where('medicine_id', $medicine)
            ->where('status', '0')
            ->count();
            
            if ($mdcStock < $qty) {
                DB::rollBack();
                Session::flash('error', 'Stock Lebih sedikit dari total Stock yang ingin dikeluarkan, Stock saat ini adalah '.$mdcStock);
                return redirect()->back();
            }

            MedicineStock::where('medicine_id', $medicine)
            ->limit($qty)
            ->update([
                'updated_by_id' => Auth::user()->id,
                'updated_at' => Carbon::now(),
                'status' => 1,
            ]);

            Session::flash('success', 'Sukses mengeluarkan item');
            return redirect()->back();
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
            DB::rollBack();
            return redirect()->back();
        }
    }
}
