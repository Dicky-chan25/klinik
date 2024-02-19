<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaffC extends Controller
{
    // API Select2
    public function getData(){
        $data = Staff::whereIn('status', [0,1])
        ->where('role', 'LIKE', '1') // just doctor role
        ->where('name', 'LIKE', '%'.request()->query('term').'%')->get();
        return response()->json($data);
    }
}
