<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Corporate extends Model
{
    use HasFactory;

    protected $table = 'corporate';

    protected $fillable = [
        'corpname', 
        'domain',
        'landingpage_id',
        'status',
        'created_by_id',
        'updated_by_id',
        'deleted_by_id',
        'created_by_at',
        'updated_by_at',
        'deleted_by_at',
    ];
}
