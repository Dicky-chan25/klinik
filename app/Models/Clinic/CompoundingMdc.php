<?php

namespace App\Models\Clinic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompoundingMdc extends Model
{
    use HasFactory;
    protected $table = 'c_mdc_compounding';

    protected $fillable = [
        'category',
        'price',
        'code',
        'name',
        'status',
        'created_by_id',
        'updated_by_id',
        'deleted_by_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
