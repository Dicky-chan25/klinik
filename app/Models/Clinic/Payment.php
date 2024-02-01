<?php

namespace App\Models\Clinic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'c_payment';

    protected $fillable = [
        'trx', 
        'patient_id',
        'service_id',
        'nominal',
        'discount',
        'method',
        'struct',
        'status',
        'created_by_id',
        'updated_by_id',
        'deleted_by_id',
        'created_by_at',
        'updated_by_at',
        'deleted_by_at',
    ];
	
}
