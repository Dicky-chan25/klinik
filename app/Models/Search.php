<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    public function scopeSearch($query, $keyword)
    {
        return $query->where('id_jenis', 'like', '%' . $keyword . '%');
    }
}
