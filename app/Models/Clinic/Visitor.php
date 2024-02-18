<?php

namespace App\Models\Clinic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;
    protected $table = 'c_visitor';

    protected $fillable = [
        'queue_no',
        'reg_no',
        'first_diagnose',
        'patient_id',
        'poli_id',
        'service_id',
        'method',
        'payment_method',
        'status',
        'created_by_id',
        'updated_by_id',
        'deleted_by_id',
        'created_by_at',
        'updated_by_at',
        'deleted_by_at',
    ];
}
