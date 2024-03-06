<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use App\Models\Clinic\Transaction;
use App\Models\MenuAccess;
use App\Models\Menus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TransactionC extends Controller
{
    public function filter($fromdate, $todate, $search)
    {
        $dateFilter = '';
        $searchFilter = '';
        $endWhereQry = 'c_transaction.status in (0,1) AND c_transaction.deleted_at IS NULL';
        if ($fromdate != null && $todate != null) {
            $filterfromdate = implode(' ', [str_replace('-', '/', $fromdate), '00:00:00']);
            $filtertodate = implode(' ', [str_replace('-', '/', $todate), '23:59:00']);
            $dateFilter = "DATE(c_transaction.created_at) BETWEEN '$filterfromdate' AND '$filtertodate' AND ";
        }
        if ($search != '') {
            $searchFilter = "c_transaction.name LIKE '$search%' AND ";
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

        $dataResult = Transaction::select(
            'c_transaction.id as id',
            'c_transaction.code as code',
            'c_patient.patientname as patient',
            'c_transaction.bill as bill',
            'c_transaction.pay as pay',
            'c_transaction.return as return',
            'c_transaction.status as status',
            'c_transaction.created_at as createdAt',
        )->leftJoin('c_patient', 'c_transaction.patient_id', 'c_patient.id')
        ->whereRaw($this->filter($fromdate, $todate, $search))
        ->paginate(10);

        return view('dashboard.transaction.index', compact(
            'dataResult',
            'access',
            'search',
            'fromdate',
            'todate'
        ));
    }

    public function delete($id)
    {
        Transaction::where('id', $id)->update([
            'status' => 0, //deactive
            'deleted_by_id' => Auth::user()->id, 
            'deleted_at' => Carbon::now()
        ]);
        Session::flash('success', 'Deleted Successfully');
        return back();
    }

}
