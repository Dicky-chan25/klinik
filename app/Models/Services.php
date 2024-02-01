<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;
    protected $table = 'c_service';

    protected $fillable = [
        'nameservice', 
        'price',
        'poli_id',
        'schedule_id',
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
