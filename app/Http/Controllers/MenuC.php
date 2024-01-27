<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuReq;
use App\Models\MenuAccess;
use App\Models\Menus;
use App\Models\UserLevels;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MenuC extends Controller
{
    public function filter($fromdate, $todate, $search)
    {
        $dateFilter = '';
        $searchFilter = '';
        $endWhereQry = 'status in (0,1) AND is_parent IN (0,1) AND deleted_at IS NULL';
        if ($fromdate != null && $todate != null) {
            $filterfromdate = implode(' ', [str_replace('-', '/', $fromdate), '00:00:00']);
            $filtertodate = implode(' ', [str_replace('-', '/', $todate), '23:59:00']);
            $dateFilter = "DATE(created_at) BETWEEN '$filterfromdate' AND '$filtertodate' AND ";
        }
        if ($search != '') {
            $searchFilter = "menuname LIKE '$search%' AND ";
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

        $dataResult = Menus::select(
            'menus.id as menuId',
            'menus.menuname as menuName',
            'menus.is_parent as isParent',
            'menus.status as status',
            'menus.created_at as createdAt',
        )->whereRaw($this->filter($fromdate, $todate, $search))
        ->paginate(10);

        return view('dashboard.settings.menus.index', compact(
            'dataResult',
            'access',
            'search',
            'fromdate',
            'todate'
        ));
    }

    public function create()
    {
        $parentMenu = Menus::select('id', 'menuname')
        ->where('is_parent', '1')
        ->where('deleted_at', null)
        ->get();
        return view('dashboard.settings.menus.create', compact('parentMenu'));
    }

    public function edit($id)
    {
        $dataDetail = Menus::find($id);
        return view('dashboard.settings.menus.edit', compact('dataDetail'));
    }

    
    public function detail($id)
    {
        $dataDetail = Menus::select(
            'menus.id as menuId',
            'menus.menuname as menuName',
            'menus.routepath as routePath',
            'menus.status as status',
            'menus.created_at as createdAt',)
        ->where('is_parent', $id)
        ->where('deleted_at', null)
        ->get();

        return view('dashboard.settings.menus.detail',  compact('dataDetail'));
    }

    public function createPost(MenuReq $req)
    {
        try {
            $req->validated();
            $menu = new Menus();
            $menuName = $req->menuname;
            $status = $req->status;
            $isParent = $req->isparent;
            $independent = $req->independent;
            $parentMenuId = $req->parentmenu;

            $menu->menuname = $menuName;
            $menu->status = $status == null || $status == false ? 0 : 1;

            // if user check 'Have Parent', isParent value from parentMenuId
            // else user check 'Have Parent', isParent value from independent
            if ($isParent == true) {
                $menu->is_parent = $parentMenuId;
            } else {
                $menu->is_parent = $independent == null || $independent == false ? 0 : 1;
            }
            $menu->level_menu = $isParent == true ? 1 : 0;
            $menu->icon_id = 1;
            $menu->sort = 0;
            $menu->child_sort = 0;
            $menu->routepath = strtolower(str_replace(' ','',$menuName));
            $menu->save();
            $getAllLevel = UserLevels::get();
            foreach ($getAllLevel as $level) {
                MenuAccess::insert([
                    'menu_id' => $menu->id,
                    'level_id' => $level->id,
                    'delete' => 0,
                    'edit' => 0,
                    'read' => 0,
                    'create' => 0,
                ]);
            }
            
            Session::flash('success', 'Created Menu Successfully');
            return redirect()->route('menus');
        } catch (\Throwable $th) {
            dd($th);
            Session::flash('error', 'Something Error, Please Refresh Page');
            return back();
        }
    }

    public function delete($id)
    {
        Menus::where('id', $id)->update([
            'deleted_by_id' => Auth::user()->id, 
            'deleted_at' => Carbon::now()
        ]);

        MenuAccess::where('menu_id', $id)->update([
            'deleted_at' => Carbon::now()
        ]);
        
        Session::flash('success', 'Deleted Successfully');
        return back();
    }

    public function editPut(Request $req, $id)
    {
        try {
            $detailMenu = Menus::where('id', $id)->first();
            $menuName = $req->menuname;
            $status = $req->status;

            Menus::where('id',$detailMenu->id)->update([
                'menuname' => $menuName == null ? $detailMenu->levelname : $menuName,
                'status' => $status == null ? $detailMenu->status : $status,
            ]);

            Session::flash('success', 'Updated Menus Successfully');
            return redirect()->route('menus');
        } catch (\Throwable $th) {
            Session::flash('error', 'Something Error, Please Refresh Page');
            return back();
        }
    }
}
