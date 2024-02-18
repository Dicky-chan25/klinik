<?php

namespace App\Livewire;

use App\Models\Clinic\Medicine;
use App\Models\Clinic\MedicineDetail;
use App\Models\Clinic\MedicineIn;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DropdownPrescription extends Component
{
    public $data = [];
    public $dataPre = [];

    public $keyword = '';
    public $keywordId = '';

    public $keywordPre = '';
    public $keywordPreId = '';

    public $select = '';
    public $isClose = false;

    public $isPreClose = false;

    public $preDosePerDay;
    public $preInfo;
    public $preStatus;
    public $preAgeRange;

    public $qty = 1;
    public $tuslah = 1200;
    public $tableSelected = [];

    public function qtyChange(){}
    
    public function keywordClick(
        $name,
        $stockId,
        $het,            
        $price,
        $exp,
        $batch,
        $reg,
        $stockTotal,
        $stockOut,
        $unit,
        $doseMin,
        $doseMax,
        $eatStatus,
        $ageRange
    )
    {
        $this->tableSelected[] = [
            'name'=>$name,
            'medicineId'=>$this->keywordId,
            'stockId'=>$stockId,
            'het'=>$het,
            'price'=>$price,
            'exp'=>$exp,
            'batch'=>$batch,
            'reg'=>$reg,
            'stockTotal'=>$stockTotal,
            'stockOut'=>$stockOut,
            'unit'=>$unit,
            'doseMin'=>$doseMin,
            'doseMax'=>$doseMax,
            'eatStatus'=>$eatStatus,
            'ageRange'=>$ageRange
        ];
        $this->isPreClose = true;
    }

    public function remove($key)
    {
        unset($this->tableSelected[$key]);
    }

    public function keywordChange()
    {
        $this->isClose = false;
    }
    public function render()
    {
        // dd($this->keyword);
        $dataRes = [];
        $whereDefault = "status in (0,1) AND deleted_at IS NULL";
        $whereDefaultDetail = "c_medicine.status in (0,1) AND c_medicine.deleted_at IS NULL";
        if ($this->keyword == '') {
            $dataRes = [];
        } else {
            if ($this->isClose == true) {
                $dataRes = [];
            } else {
                $dataRes = Medicine::where('medicinename','like', '%' . $this->keyword . '%')
                ->whereRaw($whereDefault)
                ->get();
            }
        }
        $this->data = $dataRes;

        if ($this->keywordId != '') {
            # code...
            if ($this->isPreClose == true) {
                $dataDetail = [];
            } else {
               
                $dataDetail = Medicine::select(
                    'c_medicine.medicinename as name',
                    'c_medicine_stock.id as stockId',
                    'c_medicine_stock.het_price as het',
                    'c_medicine_stock.default_price as price',
                    'c_medicine_stock.expired_date as exp',
                    'c_medicine_stock.batch_no as batch',
                    'c_medicine_stock.reg_no as reg',
                    'c_medicine_d.dose_min as doseMin',
                    'c_medicine_d.dose_max as doseMax',
                    'c_medicine_d.eating as eatStatus',
                    'm_unit.title as unit',
                    'm_age_range.agename as ageRange',
                    DB::raw('(
                        SELECT
                            COUNT(*)
                        FROM
                            c_medicine_stock_d
                        WHERE
                            c_medicine_stock_d.medicine_s_id = c_medicine_stock.id
                            AND c_medicine_stock_d.status = 1
                    ) as stockOut'),
                    DB::raw('(
                        SELECT
                            COUNT(*)
                        FROM
                            c_medicine_stock_d
                        WHERE
                            c_medicine_stock_d.medicine_s_id = c_medicine_stock.id
                    ) as stockTotal')
                )
                ->leftJoin('c_medicine_d','c_medicine_d.medicine_id','c_medicine.id')
                ->leftJoin('c_medicine_stock','c_medicine_stock.medicine_id','c_medicine.id')
                ->leftJoin('m_unit', 'c_medicine_stock.unit', 'm_unit.id')
                ->leftJoin('m_age_range', 'c_medicine_d.age', 'm_age_range.id')
                ->where('c_medicine.id', $this->keywordId)
                ->whereRaw($whereDefaultDetail)
                ->get();

                $this->keywordPreId = '';
                $this->preDosePerDay = '';
                $this->preStatus = '';
                $this->preAgeRange = '';
            }
            $this->dataPre = $dataDetail;
        }
        return view('livewire.dropdown-prescription');
    }
}
