<?php

namespace App\Models\Clinic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cppt extends Model
{
    use HasFactory;
    protected $table = 'c_cppt';

    protected $fillable = [
        'vs_hr',
        'vs_temp',
        'vs_rr',
        'vs_sp',
        'plan',
        'analysis',
        'object',
        'subject',
        'code',
        'vs_bp',
        'mr_id',
        'doctor_id',
        'status',
        'created_by_id',
        'updated_by_id',
        'deleted_by_id',
        'created_by_at',
        'updated_by_at',
        'deleted_by_at',
    ];

}
