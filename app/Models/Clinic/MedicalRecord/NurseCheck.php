<?php

namespace App\Models\Clinic\MedicalRecord;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NurseCheck extends Model
{
    use HasFactory;
    protected $table = 'c_medical_r_nurse';

    protected $fillable = [
        'mr_id',
        'anamnesis',
        'physical_check',
        'diagnosis',
        'vs_w',
        'vs_h',
        'vs_hr',
        'vs_temp',
        'vs_rr',
        'vs_sp',
        'vs_bs',	
        'vs_bp',	
        'status',
        'created_by_id',
        'updated_by_id',
        'deleted_by_id',
        'created_by_at',
        'updated_by_at',
        'deleted_by_at',	
    ];
}
