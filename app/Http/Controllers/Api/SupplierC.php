<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Clinic\Supplier;
use Illuminate\Http\Request;

class SupplierC extends Controller
{
    public function getData(){
        $data = Supplier::where('status', 1)
        ->where('suppliername', 'LIKE', '%'.request()->query('term').'%')->get();
        return response()->json($data);
    }
}
