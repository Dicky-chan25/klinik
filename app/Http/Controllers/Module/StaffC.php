<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use App\Http\Requests\StaffReq;
use App\Models\MenuAccess;
use App\Models\Menus;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class StaffC extends Controller
{
    public function filter($fromdate, $todate, $search)
    {
        $dateFilter = '';
        $searchFilter = '';
        $endWhereQry = 'm_staff.status in (0,1) AND m_staff.deleted_at IS NULL';
        if ($fromdate != null && $todate != null) {
            $filterfromdate = implode(' ', [str_replace('-', '/', $fromdate), '00:00:00']);
            $filtertodate = implode(' ', [str_replace('-', '/', $todate), '23:59:00']);
            $dateFilter = "DATE(m_staff.created_at) BETWEEN '$filterfromdate' AND '$filtertodate' AND ";
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

        $dataResult = Staff::select(
            'm_staff.id as id',
            'm_staff.code as staffCode',
            'm_staff.birthdate as birthDate',
            'm_staff.identity as identity',
            'm_staff.name as name',
            'm_staff_role.title as role',
            'm_staff.phone as phone',
            'm_staff.gender as gender',
            'm_staff.status as status',
            'm_staff.created_at as createdAt',
        )->leftJoin('m_staff_role', 'm_staff.role', 'm_staff_role.id')
        ->whereRaw($this->filter($fromdate, $todate, $search))
        ->paginate(10);

        return view('dashboard.staff.index', compact(
            'dataResult',
            'access',
            'search',
            'fromdate',
            'todate'
        ));
    }


    public function createPost(StaffReq $req){
        try {
            $req->validated();
            $name=$req->name;
            $role=$req->role;
            $email=$req->email;
            $address=$req->address;
            $birthdate=$req->birthdate;
            $birthplace=$req->birthplace;
            $identity=$req->identity;
            $phone=$req->phone;
            $gender=$req->gender;

            DB::beginTransaction();

            $codeStaffRole = DB::table('m_staff_role')->where('id', $role)->first(); 
            $codeLast = Staff::orderBy('id', 'DESC')->where('code', $codeStaffRole->code.'%')->first();
            $strCode = is_null($codeLast) ? '00001' : substr($codeLast->code, 2); // remove character H-
            $intCode = (int)$strCode;
            $finalCode = $codeStaffRole->code . str_pad(($intCode + 1), 5, "0", STR_PAD_LEFT);
                
            // insert to staff table
            $inStaff = new Staff();
            $inStaff->code = $finalCode;
            $inStaff->role = $role;
            $inStaff->name = $name;
            $inStaff->address = $address;
            $inStaff->email = $email;
            $inStaff->birthdate = $birthdate;
            $inStaff->birthplace = $birthplace;
            $inStaff->identity = $identity;
            $inStaff->phone = $phone;
            $inStaff->gender = $gender;
            $inStaff->status = 1;
            $inStaff->created_by_id = Auth::user()->id;
            $inStaff->save();

            DB::commit();

            Session::flash('success', 'Data Pegawai Baru berhasil dibuat');
            return redirect()->route('pegawai');

        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
            DB::rollBack();
        }
    }
    public function create(){
        $staffRole =  DB::table('m_staff_role')->get();
        
        return view('dashboard.staff.create', compact(
            'staffRole'
        ));
    }
}
