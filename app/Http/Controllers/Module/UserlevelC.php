<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLevelReq;
use App\Models\MenuAccess;
use App\Models\Menus;
use App\Models\UserLevels;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserlevelC extends Controller
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
            $searchFilter = "levelname LIKE '$search%' AND ";
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

        $dataResult = UserLevels::select(
            'user_levels.id as levelId',
            'user_levels.levelname as levelName',
            'user_levels.status as status',
            'user_levels.created_at as createdAt',
        )->whereRaw($this->filter($fromdate, $todate, $search))
        ->paginate(10);

        return view('dashboard.settings.userlevels.index', compact(
            'dataResult',
            'access',
            'search',
            'fromdate',
            'todate'
        ));
    }

    public function create()
    {
        return view('dashboard.settings.userlevels.create');
    }

    public function edit($id)
    {
        $dataDetail = UserLevels::find($id);
        return view('dashboard.settings.userlevels.edit', compact('dataDetail'));
    }

    
    public function detail($id)
    {
        $dataDetail = UserLevels::find($id);
        $getMenu = MenuAccess::select(
            'menus.menuname as menuName',
            'menus.id as menuId',
            'menu_access.id as accessId',
            'menu_access.read as read',
            'menu_access.edit as edit',
            'menu_access.delete as delete',
            'menu_access.read as read',
            'menu_access.create as create',
        )->leftJoin(
            'menus', 'menu_access.menu_id', 'menus.id'
        )->where('menu_access.level_id', $id)
        ->get();

        return view('dashboard.settings.userlevels.detail',  compact('dataDetail', 'getMenu'));
    }

    public function createPost(UserLevelReq $req)
    {
        try {
            $req->validated();
            $level = new UserLevels();
            $levelName = $req->levelname;
            $status = $req->status;

            $level->levelname = $levelName;
            $level->status = $status == null || $status == false ? 0 : 1;
            $level->save();
            
            $getAllMenu = Menus::get();
            foreach ($getAllMenu as $menu) {
                MenuAccess::insert([
                    'menu_id' => $menu->id,
                    'level_id' => $level->id,
                    'delete' => 0,
                    'edit' => 0,
                    'read' => 0,
                    'create' => 0,
                ]);
            }
            

            Session::flash('success', 'Created User Successfully');
            return redirect()->route('userlevels');
        } catch (\Throwable $th) {
            dd($th);
            Session::flash('error', 'Something Error, Please Refresh Page');
            return back();
        }
    }

    public function editPut(Request $req, $id)
    {
        try {
            $detailUser = UserLevels::where('id', $id)->first();
            $levelName = $req->levelname;
            $status = $req->status;

            UserLevels::where('id',$detailUser->id)->update([
                'levelname' => $levelName == null ? $detailUser->levelname : $levelName,
                'status' => $status == null ? $detailUser->status : $status,
            ]);

            Session::flash('success', 'Updated User Successfully');
            return redirect()->route('userlevels');
        } catch (\Throwable $th) {
            Session::flash('error', 'Something Error, Please Refresh Page');
            return back();
        }
    }

    public function delete($id)
    {
        UserLevels::where('id', $id)->update([
            'status' => 0, //deactive
            'deleted_by_id' => Auth::user()->id, 
            'deleted_at' => Carbon::now()
        ]);

        MenuAccess::where('level_id', $id)->update([
            'deleted_at' => Carbon::now()
        ]);
        
        Session::flash('success', 'Deleted Successfully');
        return back();
    }

    public function updateAccess($id,$access,$value){
        switch ($access) {
            case 'read':
                MenuAccess::where('id',$id)->update([
                    'read' => $value == 0 ? 1 : 0
                ]);  
                break;
            case 'edit':
                MenuAccess::where('id',$id)->update([
                    'edit' => $value == 0 ? 1 : 0
                ]);  
                break;
            case 'delete':
                MenuAccess::where('id',$id)->update([
                    'delete' => $value == 0 ? 1 : 0
                ]);  
                break;
            case 'create':
                MenuAccess::where('id',$id)->update([
                    'create' => $value == 0 ? 1 : 0
                ]);  
                break;
            default:
                break;
        }
        Session::flash('success', 'Updated Access Level User Successfully');
        return redirect()->back();
    }

}
