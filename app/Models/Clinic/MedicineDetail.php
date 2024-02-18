<?php

namespace App\Models\Clinic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineDetail extends Model
{
    use HasFactory;
    protected $table = 'c_medicine_d';

    protected $fillable = [
        'medicine_id', 
        'dose_max',
        'dose_min',
        'age',
        'eating',
        'status',
        'created_by_id',
        'updated_by_id',
        'deleted_by_id',
        'created_by_at',
        'updated_by_at',
        'deleted_by_at',		
     ];
}
