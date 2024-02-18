<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use App\Http\Requests\ActionReq;
use App\Models\Clinic\Action;
use App\Models\MenuAccess;
use App\Models\Menus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ActionC extends Controller
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
            $searchFilter = "title LIKE '$search%' AND ";
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

        $dataResult = Action::whereRaw($this->filter($fromdate, $todate, $search))
        ->paginate(10);

        return view('dashboard.master_data.action.index', compact(
            'dataResult',
            'access',
            'search',
            'fromdate',
            'todate'
        ));
    }

    public function createPost(ActionReq $req){
        try {
            $req->validated();
            $name=$req->name;
            $price=$req->price;
            $code=$req->code;

            DB::beginTransaction();

            // insert to action table
            $inAct = new Action();
            $inAct->code = $code;
            $inAct->title = $name;
            $inAct->price = $price;
            $inAct->status = 1;
            $inAct->created_by_id = Auth::user()->id;
            $inAct->save();

            DB::commit();

            Session::flash('success', 'Data Tindakan Baru berhasil dibuat');
            return redirect()->route('tindakan');

        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
            DB::rollBack();
        }
    }
    public function create(){
        $staffRole =  DB::table('m_staff_role')->get();
        // generate code
        $actCode  = 'ACT'.$this->generateRandomString(5);
        
        return view('dashboard.master_data.action.create', compact(
            'staffRole',
            'actCode'
        ));
    }

    public function delete($id){
        try {
            //code...
            DB::beginTransaction();
            Action::where('id', $id)->update([
                'status' => 0, //deactive
                'deleted_by_id' => Auth::user()->id,
                'deleted_at' => Carbon::now()
            ]);
            DB::commit();
            Session::flash('success', 'Data Tindakan berhasil dihapus');
            return redirect()->route('tindakan');

        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
        }
    }

    public function edit($id)
    {
        $dataDetail = Action::find($id);
        return view('dashboard.master_data.action.edit', 
            compact('dataDetail')
        );
    }

    public function editPut(Request $req, $id)
    {
        try {
            $detailData = Action::where('id', $id)->first();
            $name = $req->name;
            $price = $req->price;
            $status = $req->status == null || $req->status == false ? 0 : 1;

            Action::where('id',$detailData->id)->update([
                'title' => $name == null ? $detailData->name : $name,
                'price' => $price == null ? $detailData->price : $price,
                'status' => $status,
            ]);

            Session::flash('success', 'Ubah Tindakan Berhasil');
            return redirect()->route('tindakan');
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
}
