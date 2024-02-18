<?php

namespace App\Models\Clinic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;
    protected $table = 'c_medical_r_doctor_rx';

    protected $fillable = [
        'code',
        'status',
        'dose',
        'doctor_id',
        'mr_id',
        'medicine_id',
        'medicine_s_id',
        'qty',
        'time',
        'eating',
        'total',
        'created_by_id',
        'updated_by_id',
        'deleted_by_id',
        'created_by_at',
        'updated_by_at',
        'deleted_by_at',
    ];
}
