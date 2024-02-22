<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorReq;
use App\Models\Clinic\Doctor;
use App\Models\MenuAccess;
use App\Models\Menus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class DoctorC extends Controller
{
    public function filter($fromdate, $todate, $search)
    {
        $dateFilter = '';
        $searchFilter = '';
        $endWhereQry = 'c_doctor.status in (0,1) AND c_doctor.deleted_at IS NULL';
        if ($fromdate != null && $todate != null) {
            $filterfromdate = implode(' ', [str_replace('-', '/', $fromdate), '00:00:00']);
            $filtertodate = implode(' ', [str_replace('-', '/', $todate), '23:59:00']);
            $dateFilter = "DATE(c_doctor.created_at) BETWEEN '$filterfromdate' AND '$filtertodate' AND ";
        }
        if ($search != '') {
            $searchFilter = "m_staff.name LIKE '$search%' AND ";
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

        $dataResult = Doctor::select(
            'm_staff.name as name',
            'c_doctor.str as str',
            'c_doctor.id as id',
            'c_doctor.sip as sip',
            'c_doctor.price as price',
            'm_specialize.title as spName',
            'c_doctor.status as status',
            'c_doctor.updated_at as updatedAt',
        )
        ->leftJoin('m_staff', 'c_doctor.staff_id', 'm_staff.id')
        ->leftJoin('m_specialize','c_doctor.specialize', 'm_specialize.id')
        ->whereRaw($this->filter($fromdate, $todate, $search))
        ->orderBy('c_doctor.updated_at')
        ->paginate(10);

        return view('dashboard.doctor.index', compact(
            'dataResult',
            'access',
            'search',
            'fromdate',
            'todate'
        ));
    }

    public function detail($id){
        $detailData = Doctor::select(
            'c_doctor.id as id',
            'c_doctor.photo as pic',
            'c_doctor.price as price',
            'c_doctor.about as about',
            'c_doctor.str as str',
            'c_doctor.sip as sip',
            'm_staff.code as code',
            'm_staff.name as name',
            'm_staff.address as address',
            'm_staff.email as email',
            'm_staff.phone as phone',
            'm_staff.identity as identity',
            'm_staff.birthdate as birthdate',
            'm_staff.birthplace as birthplace',
            'm_specialize.title as spTitle',
        )
        ->leftJoin('m_staff','c_doctor.staff_id', 'm_staff.id')
        ->leftJoin('m_specialize','c_doctor.specialize', 'm_specialize.id')
        ->where('c_doctor.id', $id)
        ->first();

        $days = DB::table('m_day')->get();
        $schedule = DB::table('c_dr_schedule')->select(
            'm_day.title as dayTitle',
            'c_dr_schedule.id as id',
            'c_dr_schedule.time_from as timefrom',
            'c_dr_schedule.time_to as timeto'
        )
        ->leftJoin('m_day', 'c_dr_schedule.day_id', 'm_day.id')
        ->where('c_dr_schedule.doctor_id', $id)
        ->where('c_dr_schedule.status', 1)
        ->get();

        return view('dashboard.doctor.detail', compact(
            'detailData',
            'days',
            'schedule'
        ));
    }

    public function createSchedulePost(Request $req, $id){
        try {
            $req->validate([
                'day' => 'required',
                'firstTime' => 'required',
                'endTime' => 'required',
            ]);

            $day = $req->day;
            $ftime = $req->firstTime;
            $etime = $req->endTime;
            
            DB::beginTransaction();
            
            // insert to table
            $inDr = DB::table('c_dr_schedule')->insert([
                'day_id' => $day,
                'time_from' => $ftime,
                'time_to' => $etime,
                'status' => '1',
                'created_by_id' => Auth::user()->id,
                'doctor_id' => $id
            ]);

            DB::commit();

            Session::flash('success', 'Data Schedule Berhasil Dibuat');
            return redirect()->back();

        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
            DB::rollBack();
        }
    }
    public function createPost(DoctorReq $req){
        try {
            $req->validated();

            $staff = $req->staff_id;
            $sip = $req->sip;
            $str = $req->str;
            $info = $req->info;
            $specialize = $req->specialize;
            $price = $req->price;
            $user = $req->user_id;
            $pic = $req->pic;
            
            DB::beginTransaction();
            
            $picName = time().'.'.$pic->extension();  
            $pic->move(public_path('img/doctor'), $picName);
            // insert to action table
            $inDr = new Doctor();
            $inDr->price = $price;
            $inDr->str = $str;
            $inDr->info = $info;
            $inDr->photo = $picName;
            $inDr->sip = $sip;
            $inDr->specialize = $specialize;
            $inDr->staff_id = $staff;
            $inDr->user_id = $user;
            $inDr->status = 1;
            $inDr->created_by_id = Auth::user()->id;
            $inDr->save();

            DB::commit();

            Session::flash('success', 'Data Dokter Berhasil Dibuat');
            return redirect()->route('dokter');

        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
            DB::rollBack();
        }
    }
    public function create(){
        $staffRole =  DB::table('m_staff_role')->get();
        // generate code

        $codeLast = Doctor::orderBy('id', 'DESC')->first();
        $strCode = is_null($codeLast) ? '000001' : substr($codeLast->code, 3); // remove character H-
        $intCode = (int)$strCode;
        $actCode = "LBR" . str_pad(($intCode + 1), 6, "0", STR_PAD_LEFT);
        $labCategory = DB::table('c_lab_category')->get();
        
        return view('dashboard.doctor.create', compact(
            'staffRole',
            'actCode',
            'labCategory'
        ));
    }

    public function delete($id){
        try {
            //code...
            DB::beginTransaction();
            Doctor::where('id', $id)->update([
                'status' => 0, //deactive
                'deleted_by_id' => Auth::user()->id,
                'deleted_at' => Carbon::now()
            ]);
            DB::commit();
            Session::flash('success', 'Data Laborat berhasil dihapus');
            return redirect()->route('laborat');

        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
        }
    }

    public function deleteSchedule($id){
        try {
            //code...
            DB::beginTransaction();
            DB::table('c_dr_schedule')->where('id', $id)->update([
                'status' => 0, //deactive
                'deleted_by_id' => Auth::user()->id,
                'deleted_at' => Carbon::now()
            ]);
            DB::commit();
            Session::flash('success', 'Data Jadwal berhasil dihapus');
            return redirect()->back();

        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
        }
    }

    public function edit($id)
    {
        $dataDetail = Doctor::find($id);
        
        return view('dashboard.doctor.edit', 
            compact('dataDetail')
        );
    }

    public function editPut(Request $req, $id)
    {
        try {
            $detailData = Doctor::where('id', $id)->first();
            $pic = $req->pic;
            $str = $req->str;
            $sip = $req->sip;
            $price = $req->price;
            $status = $req->status == null || $req->status == false ? 0 : 1;

            if ($pic != null) {
                // delete old image
                $image_path = "img/doctor/".$detailData->photo;
                if(File::exists($image_path)) {
                    File::delete($image_path);
                }
                // insert new image
                $picName = time().'.'.$pic->extension();  
                $pic->move(public_path('img/doctor'), $picName);
                // send to database
                Doctor::where('id',$detailData->id)->update([
                    'photo' => $picName
                ]);
            }

            Doctor::where('id',$detailData->id)->update([
                'str' => $str == null ? $detailData->str : $str,
                'sip' => $sip == null ? $detailData->sip : $sip,
                'price' => $price == null ? $detailData->price : $price,
                'status' => $status,
            ]);

            Session::flash('success', 'Ubah Dokter Berhasil');
            return redirect()->route('dokter');
        } catch (\Throwable $th) {
            dd($th);
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

    function clean($string) {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
     
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
     }

}
