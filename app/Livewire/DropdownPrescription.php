<?php

namespace App\Livewire;

use App\Models\Clinic\Medicine;
use App\Models\Clinic\MedicineDetail;
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

    public function keywordPreChange()
    {
        $this->isPreClose = false;
    }

    public function keywordChange()
    {
        $this->isClose = false;
        // $this->isPreClose = true;
    }
    public function render()
    {
        // dd($this->keyword);
        $dataRes = [];
        $whereDefault = "status in (0,1) AND deleted_at IS NULL";
        $whereDefaultDetail = "c_medicine_d.status in (0,1) AND c_medicine_d.deleted_at IS NULL";
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
               
                $dataDetail = MedicineDetail::select(
                    'c_medicine_d.id as detailId',
                    'c_medicine_d.info as info',
                    'c_medicine_d.dose as dosePerDay',
                    'c_medicine_d.eating_status as eatStatus',
                    'c_medicine_age.agename as ageRange',
                )
                ->leftJoin('c_medicine_age' , 'c_medicine_d.age_status','c_medicine_age.id' )
                ->where('c_medicine_d.medicine_id', $this->keywordId)
                ->whereRaw($whereDefaultDetail)
                ->get();
                $this->keywordPreId = '';
                $this->preDosePerDay = '';
                $this->preInfo = '';
                $this->preStatus = '';
                $this->preAgeRange = '';
            }
            $this->dataPre = $dataDetail;
        }
        return view('livewire.dropdown-prescription');
    }
}
