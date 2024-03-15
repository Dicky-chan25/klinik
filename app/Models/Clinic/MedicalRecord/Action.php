<?php

namespace App\Models\Clinic\MedicalRecord;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;
    protected $table = 'c_medical_r_action';

    protected $fillable = [
        'rm_id',
        'code',
        'blood_id',
        'object',
        'assesment',
        'subject',
        'plan',
        'temp',
        'weight',
        'height',
        'pulse',
        'blood_press',
        'waist',
        'color_blind',
        'status',
        'created_by_id',
        'updated_by_id',
        'deleted_by_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
