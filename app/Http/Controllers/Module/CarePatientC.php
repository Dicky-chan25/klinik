<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use App\Models\Clinic\Registration;
use App\Models\MenuAccess;
use App\Models\Menus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CarePatientC extends Controller
{
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
}
