<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrescriptMedicEquip extends Model
{
    use HasFactory;
    protected $table = 'c_medical_r_doctor_me';

    protected $fillable = [
        'mr_id', 
        'doctor_id', 
        'me_dr_id', 
        'diagnosis',
        'me_list',
        'info',
        'checked_at',
        'code',
        'status',
        'created_by_id',
        'updated_by_id',
        'deleted_by_id',
        'created_by_at',
        'updated_by_at',
        'deleted_by_at',
    ];
}
