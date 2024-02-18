<?php

namespace App\Models\Clinic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineIn extends Model
{
    use HasFactory;
    protected $table = 'c_medicine_stock';

    protected $fillable = [
        'het_price',
        'expired_date',
        'production_date',
        'batch_no',
        'reg_no',
        'medicine_id',
        'unit',
        'qty',
        'status',
        'weight',
        'shape_category',
        'm_category_id',
        'default_price',
        'created_by_id',
        'updated_by_id',
        'deleted_by_id',
        'created_by_at',
        'updated_by_at',
        'deleted_by_at',	
    ];
}
