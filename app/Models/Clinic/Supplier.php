<?php

namespace App\Models\Clinic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $table = 'c_supplier';

    protected $fillable = [
        'officercontact',
        'category',
        'officername',
        'address',
        'suppliername',
        'status',
        'created_by_id',
        'updated_by_id',
        'deleted_by_id',
        'created_by_at',
        'updated_by_at',
        'deleted_by_at',
    ];
}
