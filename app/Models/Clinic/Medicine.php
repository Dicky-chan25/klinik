<?php

namespace App\Models\Clinic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;
    protected $table = 'c_mdc';

    protected $fillable = [
        'code', 
        'code_mdc',
        'unit_id', 
        'category_id', 
        'supplier_id', 
        'price_per_unit', 
        'age_status', 
        'exp_date', 
        'name', 
        'qty',
        'image',
        'status',
        'created_by_id',
        'updated_by_id',
        'deleted_by_id',
        'created_by_at',
        'updated_by_at',
        'deleted_by_at',	
        
        
    ];
}
