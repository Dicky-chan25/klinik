<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserReq;
use App\Models\MenuAccess;
use App\Models\Menus;
use App\Models\User;
use App\Models\UserLevels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserC extends Controller
{

    public function filter($fromdate, $todate, $search)
    {
        $dateFilter = '';
        $searchFilter = '';
        $endWhereQry = 'users.status in (0,1)';
        if ($fromdate != null && $todate != null) {
            $filterfromdate = implode(' ', [str_replace('-', '/', $fromdate), '00:00:00']);
            $filtertodate = implode(' ', [str_replace('-', '/', $todate), '23:59:00']);
            $dateFilter = "DATE(users.created_at) BETWEEN '$filterfromdate' AND '$filtertodate' AND ";
        }
        if ($search != '') {
            $searchFilter = "
            users.firstname LIKE '$search%'
            OR users.lastname LIKE '$search%'
            OR users.username LIKE '$search%'
            OR users.email LIKE '$search%'
            OR user_levels.levelname LIKE '$search%'
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
        $fromdate = $request->fromDate == null ? '' : $request->fromDate;
        $todate = $request->toDate == null ? '' : $request->toDate;
        $search = $request->search == null ? '' : $request->search;

        $dataResult = User::select(
            'users.id as userId',
            'users.firstname as fName',
            'users.lastname as lName',
            'users.username as uName',
            'users.email as email',
            'user_levels.levelname as levelName',
            'users.created_at as createdAt',
        )->leftJoin(
            'user_levels',
            'users.level_id',
            'user_levels.id'
        )->whereRaw($this->filter($fromdate, $todate, $search))
            ->paginate(10);

        return view('dashboard.settings.users.index', compact(
            'dataResult',
            'access',
            'search',
            'fromdate',
            'todate'
        ));
    }

    public function create()
    {
        $dataUserLevel = UserLevels::get();
        return view('dashboard.settings.users.create', compact('dataUserLevel'));
    }

    public function edit()
    {
        return view('dashboard.settings.users.edit');
    }

    public function createPost(UserReq $req)
    {
        try {
            $req->validated();
            $user = new User();
            $firstName = $req->fname;
            $lastName = $req->lname;
            $userName = $req->username;
            $email = $req->email;
            $password = $req->pwd;
            $levelId = $req->userlevel;

            $user->firstname = $firstName;
            $user->lastname = $lastName;
            $user->username = $userName;
            $user->email = $email;
            $user->password = Hash::make($password);
            $user->level_id = $levelId;
            $user->save();

            Session::flash('success', 'Created User Successfully');
            return redirect()->route('users');
        } catch (\Throwable $th) {
            Session::flash('error', 'Something Error, Please Refresh Page');
            return back();
        }
    }

    public function delete($id){
        User::where('id', $id)->delete();
        Session::flash('success', 'Deleted Successfully');
        return back();
    }
}
