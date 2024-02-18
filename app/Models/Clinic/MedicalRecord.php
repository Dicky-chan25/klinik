<?php

namespace App\Models\Clinic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    use HasFactory;
    protected $table = 'c_medical_record';

    protected $fillable = [
        'rm_code', 
        'age',
        'patient_id',
        'visitor_id',
        'doctor_id',
        'blood_id',
        'service_id',
        'complaint',
        'diagnose',
        'action',
        'weight',
        'height',
        'waist',
        'status',
        'created_by_id',
        'updated_by_id',
        'deleted_by_id',
        'created_by_at',
        'updated_by_at',
        'deleted_by_at',
    ];
}
