<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenParams extends Model
{
    use HasFactory;

    protected $table = 'general_params';

    protected $fillable = [
        'param', 
        'desc',
        'value',
        'created_by_at',
        'updated_by_at',
        'deleted_by_at',
    ];
}
