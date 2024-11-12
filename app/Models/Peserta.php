<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Peserta extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nama',
        'merchant',
        'titik_kumpul',
        'nomor_bus',
        'kode_peserta',
        'is_valid'
    ];
    protected $dates = ['deleted_at'];

    public function undian()
    {
        return $this->hasMany(Undian::class);
    }
}
