<?php

namespace App\Models\Clinic\MedicalRecord;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObatNonRacik extends Model
{
    use HasFactory;
    protected $table = 'c_medical_r_onr';

    protected $fillable = [
        'rm_id',
        'code',
        'total_price',
        'desc',
        'status',
        'created_by_id',
        'updated_by_id',
        'deleted_by_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
