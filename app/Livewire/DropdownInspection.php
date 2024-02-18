<?php

namespace App\Livewire;

use App\Models\Clinic\Inspection;
use App\Models\Clinic\InspectList;
use Livewire\Component;

class DropdownInspection extends Component
{
    public $data = [];
    public $price = 0;
    public $info = '';
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
                $dataRes = InspectList::select('id', 'title', 'price', 'info')
                ->where('title', 'like', '%' . $this->keyword . '%')
                ->whereRaw($whereDefault)
                ->get();
            }
        }
        $this->data = $dataRes;
        return view('livewire.dropdown-inspection');
    }
}
