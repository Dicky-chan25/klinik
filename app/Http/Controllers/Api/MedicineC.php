<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Clinic\CompoundingMdc;
use App\Models\Clinic\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MedicineC extends Controller
{
    public function getDataOnr(){
        $data = 
        Medicine::select(
            'c_mdc.id as medId',
            'c_mdc.code as code',
            'c_mdc.code_mdc as codeMdc',
            'c_mdc.name as medName',
            'c_mdc.exp_date as exp',
            'c_mdc.price_per_unit as ppu',
            'm_unit.title as title',
            'c_mdc_category.name as nameCat',
            DB::raw('(
                SELECT
                    COUNT(*)
                FROM
                    c_mdc_stock
                WHERE
                    c_mdc_stock.medicine_id = c_mdc.id
                    AND c_mdc_stock.status = 1
            ) as stockout')
        )
        ->leftJoin('m_unit', 'c_mdc.unit_id', 'm_unit.id')
        ->leftJoin('c_mdc_category', 'c_mdc.category_id', 'c_mdc_category.id')
        ->where('c_mdc.name', 'LIKE', '%'.request()->query('term').'%')
        ->get();


        return response()->json($data);
    }

    public function getDataOr(){
        $data = CompoundingMdc::select(
            'c_mdc_compounding.id as medId',
            'c_mdc_compounding.code as code',
            'c_mdc_compounding.name as medName',
            'c_mdc_compounding.price as price',
        )
        ->where('c_mdc_compounding.name', 'LIKE', '%'.request()->query('term').'%')
        ->get();
        return response()->json($data);
    }
}
