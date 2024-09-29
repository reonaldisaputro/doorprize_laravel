<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subkategori extends Model
{
    use HasFactory;

    protected $fillable = ['kategori_id', 'nama', 'qty'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function undians()
    {
        return $this->hasMany(Undian::class);
    }
}
