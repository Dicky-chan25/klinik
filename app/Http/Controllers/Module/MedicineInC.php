<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use App\Http\Requests\MedicineInReq;
use App\Models\Clinic\MedicineCategory;
use App\Models\Clinic\MedicineDetail;
use App\Models\Clinic\MedicineIn;
use App\Models\Clinic\MedicineStock;
use App\Models\MenuAccess;
use App\Models\Menus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MedicineInC extends Controller
{
    public function filter($fromdate, $todate, $search)
    {
        $dateFilter = '';
        $searchFilter = '';
        $endWhereQry = 'c_medicine_stock.status in (0,1) AND c_medicine_stock.deleted_at IS NULL';
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
            'c_medicine_stock.id as medsId',
            'c_medicine_stock.reg_no as reg',
            'm_unit.title as unit',
            'c_medicine_stock.batch_no as batch',
            'c_medicine_stock.het_price as het',
            'c_medicine_stock.default_price as price',
            'c_medicine.medicinename as medsName',
            'c_medicine.supplier as supplier',
            'c_medicine_stock.qty as qty',
            'c_medicine_stock.expired_date as expAt',
            DB::raw('(
                SELECT
                    COUNT(*)
                FROM
                    c_medicine_stock_d
                WHERE
                    c_medicine_stock_d.medicine_s_id = c_medicine_stock.id
                    AND c_medicine_stock_d.status = 1
            ) as stockout')
        )
            ->leftJoin('c_medicine', 'c_medicine_stock.medicine_id', 'c_medicine.id')
            ->leftJoin('m_unit', 'c_medicine_stock.unit', 'm_unit.id')
            ->whereRaw($this->filter($fromdate, $todate, $search))
            ->paginate(10);

        return view('dashboard.medicine.in.index', compact(
            'dataResult',
            'access',
            'search',
            'fromdate',
            'todate'
        ));
    }

    public function create()
    {
        $categoryMdc = MedicineCategory::get();
        $mAgeRange = DB::table('m_age_range')->get();
        $mUnit = DB::table('m_unit')->get();
        $mShape = DB::table('m_medicine_shape')->get();
        return view('dashboard.medicine.in.create', compact(
            'categoryMdc',
            'mAgeRange',
            'mUnit',
            'mShape',
        ));
    }

    public function detail($id)
    {
        $detailStock = MedicineStock::select(
            'c_medicine_stock_d.id as id',
            'c_medicine_stock_d.barcode as barcode',
            'c_medicine_stock_d.status as status',
            'c_medicine_stock_d.created_at as createdAt',
            'c_medicine_stock_d.updated_at as updatedAt',
        )
            ->where('medicine_s_id', $id)
            ->whereRaw('status in (0,1) AND deleted_at IS NULL')
            ->paginate(5);

        return view('dashboard.medicine.in.detail', compact(
            'detailStock',
        ));
    }

    public function createPost(MedicineInReq $req)
    {
        try {
            $req->validated();
            $medicine = $req->medicine;
            $noreg = $req->noreg;
            $nobatch = $req->nobatch;
            $pdate = $req->pdate;
            $expdate = $req->expdate;
            $price = $req->price;
            $het = $req->het;
            $category = $req->category;
            $unit = $req->unit;
            $weight = $req->weight;
            $qty = $req->qty;
            $shape = $req->shape;
            $inputs = $req->inputs;
            $status = 1;

            DB::beginTransaction();
            // insert to medical record table
            $insertStockMdc = new MedicineIn();
            $insertStockMdc->medicine_id = $medicine;
            $insertStockMdc->medicine_id = $medicine;
            $insertStockMdc->qty = $qty;
            $insertStockMdc->het_price = $het;
            $insertStockMdc->expired_date = $expdate;
            $insertStockMdc->production_date = $pdate;
            $insertStockMdc->batch_no = $nobatch;
            $insertStockMdc->reg_no = $noreg;
            $insertStockMdc->unit = $unit;
            $insertStockMdc->weight = $weight;
            $insertStockMdc->shape_category = $shape;
            $insertStockMdc->m_category_id = $category;
            $insertStockMdc->default_price = $price;
            $insertStockMdc->created_by_id = Auth::user()->id;
            $insertStockMdc->status = $status;
            $insertStockMdc->save();
            $lastInsertId = $insertStockMdc->id;

            // insert detail medicine
            foreach ($inputs as $value) {
                # code...
                MedicineDetail::insert([
                    'medicine_id' => $medicine,
                    'created_by_id' => Auth::user()->id,
                    'dose_min' => $value['dosemin'],
                    'dose_max' => $value['dosemax'],
                    'age' => $value['age'],
                    'eating' => $value['eating'],
                    'status' => 1,
                ]);
            }

            for ($i = 0; $i < $qty; $i++) {
                $barcodeLast = MedicineStock::orderBy('id', 'DESC')->first();
                $strBarcode = is_null($barcodeLast) ? '0000000001' : substr($barcodeLast->barcode, 2); // remove character H-
                $intBarcode = (int)$strBarcode;
                $finalBarcode = "H" . str_pad(($intBarcode + 1), 10, "0", STR_PAD_LEFT);
                MedicineStock::insert([
                    'medicine_id' => $medicine,
                    'medicine_s_id' => $lastInsertId,
                    'barcode' => $finalBarcode,
                    'created_by_id' => Auth::user()->id,
                    'status' => 0,
                ]);
            }

            DB::commit();

            Session::flash('success', 'Data Stock Obat Baru berhasil dibuat');
            return redirect()->route('obatmasuk');
        } catch (\Throwable $th) {
            dd($th);
            DB::rollBack();
            Session::flash('error', 'Something Error, Please Refresh Page');
            return back();
        }
    }

    public function delete($id)
    {
        // dd($id);
        try {
            $countStock = MedicineStock::where('medicine_id', $id)
                ->where('status', 1)
                ->count();
            // dd($checkInStock);
            if ($countStock == 0) {
                # code...
                DB::beginTransaction();
                MedicineIn::where('id', $id)->update([
                    'status' => 0, //deactive
                    'deleted_by_id' => Auth::user()->id,
                    'deleted_at' => Carbon::now()
                ]);

                MedicineStock::where('medicine_s_id', $id)->delete();
                DB::commit();
            } else {
                DB::rollBack();
                Session::flash('error', 'Sudah Ada Barang Keluar, Stock ini tidak bisa dihapus dari sistem');
                return redirect()->back();
            }

            Session::flash('success', 'Stock berhasil di delete');
            return redirect()->back();
        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
            DB::rollBack();
            Session::flash('error', 'Something Error, Please Refresh Page');
            return back();
        }
    }
}
