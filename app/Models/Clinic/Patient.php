<?php

namespace App\Models\Clinic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $table = 'c_patient';

    protected $fillable = [
        'satusehat', 
        'language',
        'bpjs', 
        'patientname',
        'address',
        'birthdate',
        'birthplace',
        'identity',
        'phone',
        'religion_id',
        'career_id',
        'education_id',
        'gender',
        'status',
        'created_by_id',
        'updated_by_id',
        'deleted_by_id',
        'created_by_at',
        'updated_by_at',
        'deleted_by_at',
    ];
}
