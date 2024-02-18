<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CheckBoxLab extends Component
{
    public $dataCategory = [];
    public $data = [];

    public function mount(){
        $labCategory = DB::table('c_lab_category')
        ->get();

        $labData = DB::table('c_laboratory')
        ->select(
            'c_laboratory.id as labId', 
            'c_laboratory.name as name', 
            'c_lab_category.name as cName'
        )
        ->leftJoin('c_lab_category', 'c_laboratory.category', 'c_lab_category.id')
        ->get();

        $this->dataCategory = $labCategory;
        $this->data = $labData;
    }

    public function render()
    {
        return view('livewire.check-box-lab');
    }
}
