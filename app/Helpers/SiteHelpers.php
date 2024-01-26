<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SiteHelpers
{
    public static function main_menu()
    {
        $main_menu = DB::table("menu_access")
        ->join('menus','menus.id','=','menu_access.menu_id')
        ->select('menus.*','menu_access.read','menu_access.create','menu_access.edit','menu_access.delete')
        ->where('menu_access.level_id', Auth::user()->level_id)
        ->where('menus.level_menu', 0)
        ->where('menus.status', 1)
        ->where('menu_access.read', 1)
        ->orderBy('menus.sort')
        ->get();

        return $main_menu;
    }
    public static function sub_menu()
    {
        $sub_menu = DB::table("menu_access")
        ->join('menus','menus.id','=','menu_access.menu_id')
        ->select('menus.*','menu_access.read','menu_access.create','menu_access.edit','menu_access.delete')
        ->where('menu_access.level_id', Auth::user()->level_id)
        ->where('menus.level_menu', 1)
        ->where('menus.status', 1)
        ->where('menu_access.read', 1)
        ->orderBy('menus.child_sort')
        ->get();

        return $sub_menu;
    }

}
