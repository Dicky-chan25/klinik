<?php

namespace App\Models\Clinic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;
    protected $table = 'c_prescription';

    protected $fillable = [
        'code',
        'mr_id',
        'medicine_id',
        'medicine_d_id',
        'qty',
        'info',
        'created_by_id',
        'updated_by_id',
        'deleted_by_id',
        'created_by_at',
        'updated_by_at',
        'deleted_by_at',
    ];
}
