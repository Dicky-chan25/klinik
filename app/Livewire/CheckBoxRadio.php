<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CheckBoxRadio extends Component
{
    public $dataCategory = [];
    public $data = [];

    public function mount(){
        $labCategory = DB::table('c_radio_category')
        ->get();

        $labData = DB::table('c_radiology')
        ->select(
            'c_radiology.id as radioId', 
            'c_radiology.name as name', 
            'c_radio_category.name as cName'
        )
        ->leftJoin('c_radio_category', 'c_radiology.category', 'c_radio_category.id')
        ->get();

        $this->dataCategory = $labCategory;
        $this->data = $labData;
    }

    public function render()
    {
        return view('livewire.check-box-radio');
    }
}
