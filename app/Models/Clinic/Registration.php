<?php

namespace App\Models\Clinic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;
    protected $table = 'c_registration';

    protected $fillable = [
        'queue_no', 
        'rm_code', 
        'alergy', 
        'reg_no', 
        'doctor_id', 
        'patient_id', 
        'payment_method', 
        'entry_method', 
        'admin_action', 
        'payment_status', 
        'nursing_status', 
        'status',
        'is_submit',
        'is_call',
        'created_by_id',
        'updated_by_id',
        'deleted_by_id',
        'created_by_at',
        'updated_by_at',
        'deleted_by_at',
    ];
}
