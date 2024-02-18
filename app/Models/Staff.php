<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    protected $table = 'm_staff';

    protected $fillable = [
        'code', 
        'name',
        'role',
        'email',
        'address',
        'birthdate',
        'birthplace',
        'identity',
        'phone',
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
