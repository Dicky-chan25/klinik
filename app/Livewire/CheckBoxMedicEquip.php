<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CheckBoxMedicEquip extends Component
{
    public $dataCategory = [];
    public $data = [];

    public function mount(){
        $labCategory = DB::table('c_me_category')
        ->get();

        $labData = DB::table('c_me')
        ->select(
            'c_me.id as meId', 
            'c_me.name as name', 
            'c_me_category.name as cName'
        )
        ->leftJoin('c_me_category', 'c_me.category', 'c_me_category.id')
        ->get();

        $this->dataCategory = $labCategory;
        $this->data = $labData;
    }

    public function render()
    {
        return view('livewire.check-box-medic-equip');
    }
}
