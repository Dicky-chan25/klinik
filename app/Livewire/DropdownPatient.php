<?php

namespace App\Livewire;

use App\Models\Clinic\Patient;
use Livewire\Component;

class DropdownPatient extends Component
{
    public $data = [];
    public $keyword = '';
    public $keywordId = '';
    public $select = '';
    public $isClose = false;

    public function keywordChange()
    {
        $this->isClose = false;
    }
    public function render()
    {
        // dd($this->keyword);
        $dataRes = [];
        $whereDefault = "status in (0,1) AND deleted_at IS NULL";
        if ($this->keyword == '') {
            $dataRes = [];
        } else {
            if ($this->isClose == true) {
                $dataRes = [];
            } else {
                $dataRes = Patient::select('id', 'patientname')->where('patientname', 'like', '%' . $this->keyword . '%')->whereRaw($whereDefault)->get();
            }
        }
        $this->data = $dataRes;
        return view('livewire.dropdown-patient');
    }
}
