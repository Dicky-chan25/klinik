<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueuePatient extends Model
{
    use HasFactory;
    protected $table = 'c_queue';

    protected $fillable = [
        'queue',
        'admin_id',
        'patient_id',
        'service_id',
        'status',
        'created_at',			
        'updated_at',
    ];
}
