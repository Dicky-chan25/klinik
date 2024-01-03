<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;

    protected $fillable = [
        'kodeobat',
        'stok',
        'id_jenis',
        'namaobat',
        'dosis',
        'harga',
        'expired',
        'image',
    ];

    protected $guarded =['id'];

    public function rekam(){
        return $this->hasMany(Pasien::class);
    }

    public function jenis(){
        return $this->belongsTo(Jenis::class, 'id_jenis');
    }
}
