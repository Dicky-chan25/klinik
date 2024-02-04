<?php

namespace App\Livewire;

use App\Models\Clinic\Medicine;
use App\Models\Prescription;
use Livewire\Component;

class DropdownMedicine extends Component
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
                $dataRes = Medicine::where('medicinename','like', '%' . $this->keyword . '%')->whereRaw($whereDefault)->get();
            }
        }
        $this->data = $dataRes;
        return view('livewire.dropdown-medicine');
    }
}
