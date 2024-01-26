<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuAccess extends Model
{
    use HasFactory;

    protected $table = 'menu_access';

    protected $fillable = [
        'menu_id', 
        'level_id',
        'delete',
        'edit',
        'read',
        'create',
        'created_by_at',
        'updated_by_at',
        'deleted_by_at',
    ];
}
